<?php


namespace common\models;


class Driver extends \common\models\generated\models\Driver
{
    /**
     * получить скорость движения водителя по средней скорости движения автобусов, к которым он привязан
     * @param string $mode
     * @return int
     */
    public function getSpeed(string $mode = 'max'): int
    {
        return \Yii::$app->cache->getOrSet(
            "driver_speed_" . $mode . "_" . $this->id,
            function () use ($mode) {

                $orderWay = $mode == 'max' ? 'DESC' : 'ASC';

                $model = $this
                    ->getBuses()
                    ->select('avg_speed')
                    ->orderBy(Bus::tableName() . '.avg_speed ' . $orderWay)
                    ->one();

                return $model ? $model->avg_speed : 0;

            },
            MIN_15
        );
    }

    /**
     * вычислить возраст по дате рождения
     * @return int
     * @throws
     */
    public function getAge(): int
    {
        if ($this->birthday) {
            $datetime = new \DateTime($this->birthday);
            $interval = $datetime->diff(new \DateTime(date("Y-m-d")));
            return $interval->format("%Y");
        }
        return 0;
    }
}