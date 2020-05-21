<?php

use yii\db\Migration;

/**
 * Class m200519_201046_create_table_buses
 */
class m200519_201046_create_table_buses extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable(\common\helpers\App::TABLE_BUSES, [
            'id' => $this->primaryKey(),
            'name' => $this->string(32),
            'avg_speed' => $this->smallInteger(3),
        ], $tableOptions);

        $this->createIndex(
            'idx-avg_speed',
            \common\helpers\App::TABLE_BUSES,
            'avg_speed'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200519_201046_create_table_buses cannot be reverted.\n";
//        $this->dropIndex('idx-avg_speed', \common\helpers\App::TABLE_BUSES);
//        $this->dropTable(\common\helpers\App::TABLE_BUSES);

        return true;
    }

}
