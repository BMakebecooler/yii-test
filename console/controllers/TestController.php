<?php


namespace console\controllers;

use common\ActiveQuery;
use common\models\Bus;
use common\models\Driver;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionTest()
    {
//        echo $distance = \Yii::$app->googleMapsApi->calculateDistanceKm('sdcsdc','цувцувц');
//        die();

        echo $distance = \Yii::$app->googleMapsApi->calculateDistanceKm('Москва', 'Казань');
        die();

        $data = Driver::find()
            ->select([
                Driver::tableName() . '.*',
                Bus::tableName() . '.avg_speed'
            ])
            ->joinWith(['buses' => function (ActiveQuery $query) {
                return $query->orderBy(Bus::tableName() . '.avg_speed DESC');
            }])
            ->groupBy(Driver::tableName().'.id');

//        $q = $data->createCommand()->getRawSql();
//
//        echo '<pre>';
//        print_r($q);
//        echo '</pre>';
//        die();

        foreach ($data->each() as $d) {

            echo $d->birthday . PHP_EOL;

            echo $d->getSpeed() . PHP_EOL;

            echo $d->getAge() . PHP_EOL;
            die();

        }

    }
}