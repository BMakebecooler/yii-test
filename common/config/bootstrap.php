<?php
/**
 * Require core files
 */
require_once __DIR__ . '/../helpers.php';

/**
 * Константы времени для удобства
 */
define('MIN_1', 60);
define('MIN_5', 60 * 5);
define('MIN_10', 60 * 10);
define('MIN_15', 60 * 15);
define('MIN_25', 60 * 25);
define('MIN_30', 60 * 30);
define('HOUR_1', 60 * 60);
define('HOUR_2', 60 * 60 * 2);
define('HOUR_3', 60 * 60 * 3);
define('HOUR_4', 60 * 60 * 4);
define('HOUR_5', 60 * 60 * 5);
define('HOUR_6', 60 * 60 * 6);
define('HOUR_8', 60 * 60 * 8);

/**
 * Setting path aliases
 */
Yii::setAlias('@base', dirname(__DIR__, 2) . '/');
Yii::setAlias('@common', dirname(__DIR__, 2) . '/common');
Yii::setAlias('@api', dirname(__DIR__, 2) . '/api');
Yii::setAlias('@frontend', dirname(__DIR__, 2) . '/frontend');
Yii::setAlias('@backend', dirname(__DIR__, 2) . '/backend');
Yii::setAlias('@console', dirname(__DIR__, 2) . '/console');
Yii::setAlias('@storage', dirname(__DIR__, 2) . '/storage');
Yii::setAlias('@tests', dirname(__DIR__, 2) . '/tests');

/**
 * Setting url aliases
 */
Yii::setAlias('@apiUrl', env('API_HOST_INFO') . env('API_BASE_URL'));
Yii::setAlias('@frontendUrl', env('FRONTEND_HOST_INFO') . env('FRONTEND_BASE_URL'));
Yii::setAlias('@backendUrl', env('BACKEND_HOST_INFO') . env('BACKEND_BASE_URL'));
Yii::setAlias('@storageUrl', env('STORAGE_HOST_INFO') . env('STORAGE_BASE_URL'));



