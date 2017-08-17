<?php

require_once __DIR__.'/vendor/autoload.php';

use Heise\Shariff\Backend;

/**
 * Demo Application using Shariff Backend
 */
class Application
{
    /**
     * Sample configuration
     *
     * @var array
     */
    private static $configuration = [
        'cache' => [
            'ttl' => 60
        ],
        'domains' => [
            'ENTER YOUR DOMAIN HERE'
        ],
        'services' => [
            'GooglePlus',
            'Facebook',
            'LinkedIn',
            'Reddit',
            'StumbleUpon',
            'Flattr',
            'Pinterest',
            'Xing',
            'AddThis'
        ],
        'Facebook' => [
            'app_id' => 'ENTER YOUR FACEBOOK APP-ID HERE',
            'secret' => 'ENTER YOUR FACEBOOK APP-SECRET HERE'
        ]
    ];

    public static function run()
    {
        header('Content-type: application/json');

        $url = isset($_GET['url']) ? $_GET['url'] : '';
        if ($url) {
            $shariff = new Backend(self::$configuration);
            echo json_encode($shariff->get($url));
        } else {
            echo json_encode(null);
        }
    }
}

Application::run();
