<?php


namespace api\controllers\v2;

//use common\components\cache\PageCache;
//use common\helpers\CacheHelper;

use common\models\Bus;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class BusesController extends ActiveController
{

    public $modelClass = \api\resource\v2\Bus::class;

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
        $query = Bus::find()->orderBy('name');

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);
    }

}