<?php


namespace common\models\query;


use common\models\Bus;

class DriverQuery extends \common\models\generated\query\DriverQuery
{
    public function maxSpeedQuery()
    {
        return $this
            ->getBuses()
            ->select('avg_speed')
            ->orderBy(Bus::tableName().'.avg_speed DESC');
    }
}