<?php


namespace api\resource\v2;


class Driver extends \common\models\Driver
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
                return $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
            },
            'age' => function () {
                return $this->getAge();
            },
        ];
    }
}