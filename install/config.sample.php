<?php

define('APP_REAL_PATH', str_replace('\\', '/', dirname(__FILE__)));
define('TEMPLATE_DIR', 'theme/default/');
define('LANG', '@lang');
define('PRODUCTION', true);
define('SITE_KEY', '6LdvTwkUAAAAAEo2KGjOLbA_-f4mUIAbWfTUTeRT');
define('SECRET', '6LdvTwkUAAAAAGHDc3Sx4EmXfSHPmpZX_Pu9_P-c');
date_default_timezone_set('Asia/Taipei');
$conn = array(
        'sqlite' => array(
            'driver' => 'sqlite',
            'database' => __DIR__.'/../database/production.sqlite',
            'prefix' => '',
        ),
        'mysql' => array(
            'driver' => 'mysql',
            'host' => '@host',
            'database' => '@database',
            'username' => '@username',
            'password' => '@password',
            'charset' => 'utf8mb4',
            'collation' => 'utf8_unicode_ci',
            'persistent' => false,
            'prefix' => '@prefix',
        ),
        'hbase' => array(
            'driver' => 'hbase',
            'host' => 'localhost',
            'port' => '9090',
            'SendTimeout' => 10000,
            'RecvTimeout' => 20000,
            'prefix' => '',
        ),
        'mongo' => array(
            'driver' => 'mongodb',
            'host' => 'localhost',
            'database' => 'test',
            'prefix' => '',
        ),
    );
define('CONN', $conn);
