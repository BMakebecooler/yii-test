<?php

namespace api\resource\v2;

class Bus extends \common\models\Bus
{
    /**
     * Method
     * @return array
     */
    public function fields(): array
    {
        return [
            'id' => function () {
                return $this->id;
            },
            'name' => function () {
                return $this->name;
            },
            'avg_speed' => function () {
                return $this->avg_speed;
            },
        ];
    }
}