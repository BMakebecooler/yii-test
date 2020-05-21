<?php

use yii\db\Migration;

use common\helpers\App as AppHelper;

/**
 * Class m200519_201849_create_table_buses_drivers_relations
 */
class m200519_201849_create_table_buses_drivers_relations extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(AppHelper::TABLE_DRIVERS_TO_BUSES, [
            'id' => $this->primaryKey(),
            'driver_id' => $this->integer(),
            'bus_id' => $this->integer(),
        ]);

        $this->createIndex('idx_unique_driver_id_bus_id',
            AppHelper::TABLE_DRIVERS_TO_BUSES,
            ['driver_id', 'bus_id'],
            true);

        $this->createIndex(
            'idx-driver_id',
            AppHelper::TABLE_DRIVERS_TO_BUSES,
            'driver_id'
        );

        $this->createIndex(
            'idx-bus_id',
            AppHelper::TABLE_DRIVERS_TO_BUSES,
            'bus_id'
        );

        $this->addForeignKey('fc-driver_id',
            AppHelper::TABLE_DRIVERS_TO_BUSES,
            'driver_id',
            AppHelper::TABLE_DRIVERS,
            'id',
            'CASCADE'
        );

        $this->addForeignKey('fc-bus_id',
            AppHelper::TABLE_DRIVERS_TO_BUSES,
            'bus_id',
            AppHelper::TABLE_BUSES,
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200519_201849_create_table_buses_drivers_relations cannot be reverted.\n";

//        $this->dropIndex('idx_unique_driver_id_bus_id', AppHelper::TABLE_DRIVERS_TO_BUSES);
//
//        $this->dropForeignKey('fc-driver_id', AppHelper::TABLE_DRIVERS_TO_BUSES);
//        $this->dropIndex('idx-driver_id', AppHelper::TABLE_DRIVERS_TO_BUSES);
//
//        $this->dropForeignKey('fc-bus_id', AppHelper::TABLE_DRIVERS_TO_BUSES);
//        $this->dropIndex('idx-bus_id', AppHelper::TABLE_DRIVERS_TO_BUSES);

        return true;
    }

}
