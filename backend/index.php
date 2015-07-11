<?php
require_once __DIR__.'/vendor/autoload.php';

use Heise\Shariff\Backend;

class Application
{
    public static function run()
    {
        header('Content-type: application/json');

        if (!isset($_GET["url"])) {
            echo json_encode(null);
            return;
        }
        
        $services = explode(',', $_GET['data-services']);
        foreach ($services as $key => $value) {
            $services = str_replace(array("[", "]", '"'), NULL, $services);
        }
        $servies_count = count($services);
        unset($services[$servies_count-2]);
        unset($services[$servies_count-1]);
        $services = array_values($services);

        $services = array("Facebook","Twitter","GooglePlus", "LinkedIn", "Flattr", "Pinterest", "Xing");
        $arrayconfig = Array ( "cache" => Array ("ttl" => 60, "cacheDir" => __DIR__),"domain" => $_SERVER["HTTP_HOST"] ,"services" => $services);

        $shariff = new Backend($arrayconfig);
        echo json_encode($shariff->get($_GET["url"]));
    }
}

Application::run();
