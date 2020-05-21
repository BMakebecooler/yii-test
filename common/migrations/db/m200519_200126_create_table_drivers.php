<?php

use yii\db\Migration;

/**
 * Class m200519_200126_create_table_drivers
 */
class m200519_200126_create_table_drivers extends Migration
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

        $this->createTable(\common\helpers\App::TABLE_DRIVERS, [
            'id' => $this->primaryKey(),
            'name' => $this->string(32),
            'surname' => $this->string(32),
            'patronymic' => $this->string(32),
            'birthday' => $this->date(),
        ], $tableOptions);

        $this->createIndex(
            'idx-name',
            \common\helpers\App::TABLE_DRIVERS,
            'name'
        );
        $this->createIndex(
            'idx-surname',
            \common\helpers\App::TABLE_DRIVERS,
            'surname'
        );
        $this->createIndex(
            'idx-patronymic',
            \common\helpers\App::TABLE_DRIVERS,
            'patronymic'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200519_200126_create_table_drivers cannot be reverted.\n";

//        $this->dropIndex('idx-name',\common\helpers\App::TABLE_DRIVER);
//        $this->dropIndex('idx-surname',\common\helpers\App::TABLE_DRIVER);
//        $this->dropIndex('idx-patronymic',\common\helpers\App::TABLE_DRIVER);
//
//        $this->dropTable(\common\helpers\App::TABLE_DRIVERS);

        return true;
    }
}
