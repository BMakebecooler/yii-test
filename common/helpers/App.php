<?php

namespace common\helpers;

class App
{
    const TABLE_DRIVERS = '{{%driver}}';

    const TABLE_BUSES = '{{%bus}}';

    const TABLE_DRIVERS_TO_BUSES = '{{%driver_bus}}';

    const MAX_ACTIVE_HOURS_PER_DAY = 8;

    /**
     * посчитать количество дней на прохождение пути
     * @param int $speed
     * @param int $distance
     * @return int
     */
    public static function calculateTravelDays(int $speed, int $distance): int
    {
        if ($speed > 0) {
            return round($distance / ($speed * self::MAX_ACTIVE_HOURS_PER_DAY));
        }
        return 0;
    }

}