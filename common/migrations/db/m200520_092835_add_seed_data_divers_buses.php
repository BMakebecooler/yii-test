<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m200520_092835_add_seed_data_divers_buses
 */
class m200520_092835_add_seed_data_divers_buses extends Migration
{
    const COUNT_DRIVERS = 100;

    const COUNT_BUSES = 10;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < self::COUNT_BUSES; $i++) {
            $this->insert(\common\helpers\App::TABLE_BUSES, [
                'name' => $faker->text(5) . ' ' . $faker->text(5) . ' ' . $faker->date('Y'),
                'avg_speed' => rand(40, 120)
            ]);
        }

        for ($i = 0; $i < self::COUNT_DRIVERS; $i++) {

            $this->insert(\common\helpers\App::TABLE_DRIVERS, [
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'patronymic' => $faker->firstName,
                'birthday' => $faker->date('Y-m-d', '2000-01-01')
            ]);

        }

        $drivers = \common\models\Driver::find();

        foreach ($drivers->each() as $driver) {
            $buses = \common\models\Bus::find()
                ->limit(rand(2, 5))
                ->orderBy(new Expression('rand()'));

            foreach ($buses->each() as $bus) {
                $this->insert(\common\helpers\App::TABLE_DRIVERS_TO_BUSES, [
                    'driver_id' => $driver->id,
                    'bus_id' => $bus->id
                ]);
            }
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200520_092835_add_seed_data_divers_buses cannot be reverted.\n";

//        \Yii::$app->db->createCommand()
//            ->truncateTable(\common\helpers\App::TABLE_DRIVERS_TO_BUSES)->execute();
//
//        \Yii::$app->db->createCommand()
//            ->truncateTable(\common\helpers\App::TABLE_BUSES)->execute();
//
//        \Yii::$app->db->createCommand()
//            ->truncateTable(\common\helpers\App::TABLE_DRIVERS)->execute();

        return true;
    }

}
