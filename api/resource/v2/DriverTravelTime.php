<?php


namespace api\resource\v2;


use api\controllers\v2\DriversTravelTimeController;
use common\helpers\App;

class DriverTravelTime extends \common\models\Driver
{
    /**
     * Method
     * @return array
     */
    public function fields(): array
    {
        $distance = DriversTravelTimeController::$distance;

        return [
            "id" => function () {
                return $this->id;
            },
            "name" => function () {
                return $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
            },
            "birth_date" => function () {
                return $this->birthday;
            },
            "age" => function () {
                return $this->getAge();
            },
            "travel_time" => function () use ($distance) {
                return App::calculateTravelDays(
                    $this->getSpeed(),
                    $distance
                );
            },
            //todo для отладки
//            "speed" => function () {
//                return $this->getSpeed();
//            },
        ];
    }
}