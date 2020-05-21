<?php


namespace api\controllers\v2;


use api\resource\v2\Driver;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class DriversController extends ActiveController
{
    private static $perPage = 20;

    public $modelClass = \api\resource\v2\Driver::class;

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
            ]
        ];
    }

    /**
     *
     * Method
     * @return ActiveDataProvider
     */
    public function prepareDataProvider(): ActiveDataProvider
    {
        $query = Driver::find()
            ->addOrderBy(['surname' => 'ASC'])
            ->addOrderBy(['name' => 'ASC']);

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

}