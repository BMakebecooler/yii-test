<?php


namespace api\controllers\v2;


use common\models\Bus;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\rest\OptionsAction;
use yii\rest\ViewAction;
use yii\web\HttpException;
use api\resource\v2\DriverTravelTime;

class DriversTravelTimeController extends ActiveController
{
    /**
     * @param $id
     */
    public static $distance;

    private static $perPage = 20;

    public $modelClass = DriverTravelTime::class;

    /**
     * Method
     * @return array
     */
    public function behaviors(): array
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::class,
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
            //TODO: Для реализации постраничного кеша
//            [
//                'class' => PageCache::class,
//                'duration' => CacheHelper::CACHE_TIME_BRANDS_API,
//                'variations' => CacheHelper::getBrandsViaApiVariation(),
//                'enabled' => CacheHelper::isEnabled()
//            ],
        ];
    }

    /**
     *
     * Method
     * @return array
     */
    public function actions(): array
    {
        return [
            'index' => [
                'class' => 'yii\rest\IndexAction',
                'modelClass' => $this->modelClass,
                'prepareDataProvider' => [$this, 'prepareDataProvider']
            ],
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass,
                'findModel' => [$this, 'findModel']
            ],
            'options' => [
                'class' => OptionsAction::class,

            ]
        ];
    }

    /**
     *
     * Method
     * @return ActiveDataProvider
     * @throws HttpException
     *
     */
    public function prepareDataProvider(): ActiveDataProvider
    {
        $this->calculateDistanceBetweenCities();

        //todo необходимо реализовать читабельно через констуктор запросов
//        $query = Driver::find()
//            ->select([
//                Driver::tableName() . '.*',
//                Bus::tableName() . '.avg_speed'
//            ])
//            ->joinWith(['buses' => function (ActiveQuery $query) {
//                return $query->orderBy(Bus::tableName() . '.avg_speed DESC');
//            }])
//            ->groupBy(Driver::tableName().'.id');


        $query = DriverTravelTime::find()
            ->leftJoin(Bus::tableName(), '
            `bus`.`id` = (
            SELECT b.id AS max_bus
            FROM bus b
                     LEFT JOIN `driver_bus` db ON `b`.`id` = `db`.`bus_id`
                     LEFT JOIN `driver` d ON `d`.`id` = `db`.`driver_id`
            WHERE d.id = `driver`.id
            ORDER BY b.avg_speed DESC
            LIMIT 1
            )
            ')
            ->orderBy(Bus::tableName() . '.avg_speed DESC, ' . DriverTravelTime::tableName() . '.surname');

        $perPage = \Yii::$app->request->get('per_page');
        if (!$perPage) {
            $perPage = static::$perPage;
        }

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $perPage,
                'pageSizeParam' => 'per_page',
                'validatePage' => false,
            ]
        ]);

    }

    /**
     * @param $id
     * @return array|null|\yii\db\ActiveRecord
     * @throws HttpException
     */
    public function findModel($id)
    {
        $this->calculateDistanceBetweenCities();

        $model = DriverTravelTime::findOne($id);

        if (!$model) {
            throw new HttpException(404);
        }
        return $model;
    }

    /**
     * посчитать расстояние межу двумя городами
     * @throws HttpException
     */
    private function calculateDistanceBetweenCities(): void
    {
        $from = \Yii::$app->request->get('from');
        if (!$from) {
            throw new HttpException(404);
        }
        $to = \Yii::$app->request->get('to');
        if (!$to) {
            throw new HttpException(404);
        }

        static::$distance = \Yii::$app->googleMapsApi->calculateDistanceKm($from, $to);

    }
}