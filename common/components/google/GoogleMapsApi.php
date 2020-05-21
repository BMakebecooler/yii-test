<?php

namespace common\components\google;

use \yii\base\Exception;

class GoogleMapsApi
{
    public $apiKey;

    /**
     * Вычислить расстояние между двумя адресами
     * @param string $from
     * @param string $to
     * @return int
     *
     * @throws \yii\base\Exception
     */
    public function calculateDistanceKm(string $from, string $to): int
    {
        $key = md5($from . $to);

        return \Yii::$app->cache->getOrSet(
            "distance_km_" . $key,
            function () use ($from, $to) {

                $from = urlencode($from);
                $to = urlencode($to);
                $data = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&language=ru-RU&sensor=false&key=" . $this->apiKey);
                $data = json_decode($data);

                if (isset($data->error_message)) {
                    throw new Exception($data->error_message);
                }

                if (isset($data->rows[0]->elements[0]->distance)) {

                    return round($data->rows[0]->elements[0]->distance->value / 1000);

                } else {
                    throw new Exception('NOT_FOUND');
                }
            }
        );
    }
}