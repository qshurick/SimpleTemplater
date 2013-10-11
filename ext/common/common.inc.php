<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexander.Malyk
 * Date: 10.10.13
 * Time: 10:23
 * To change this template use File | Settings | File Templates.
 */

namespace SimpleTemplate;

//print "common.inc.php is loaded\n";

define('LOG_LEVEL', 'debug');
define('LOG_PATH', __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, array('..', '..')) . DIRECTORY_SEPARATOR . 'logs'. DIRECTORY_SEPARATOR . 'app.log');

function logging($msg, $level = "info") {
    $levels = array(
        "alert" => 0,
        "fatal" => 1,
        "error" => 2,
        "warn"  => 3,
        "info"  => 4,
        "debug" => 5,
        "trace" => 6,
    );
    if (isset($levels[$level]) && $levels[LOG_LEVEL] >= $levels[$level]) {
        date_default_timezone_set("Europe/Moscow");
        $msg = "\n[" . date('d.m.Y H:i:s') . "] [" . str_pad(strtoupper($level), 5, ' ', STR_PAD_LEFT) . "] " . $msg;
        file_put_contents(LOG_PATH, $msg, FILE_APPEND);
    }
}

function load($namespace) {
    $splitPath = explode('\\', $namespace);
    $path = implode(DIRECTORY_SEPARATOR, array('..', '..', 'source', 'php', __NAMESPACE__));
    $name = '';
    $firstWord = true;
    for ($i = 0; $i < count($splitPath); $i++) {
        if ($splitPath[$i] && !$firstWord) {
            if ($i == count($splitPath) - 1)
                $name = $splitPath[$i];
            else
                $path .= DIRECTORY_SEPARATOR . $splitPath[$i];
        }
        if ($splitPath[$i] && $firstWord) {
            if ($splitPath[$i] != __NAMESPACE__)
                break;
            $firstWord = false;
        }
    }
    if (!$firstWord) {
        $fullPath = __DIR__ . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR . $name . '.php';
//        print "Trying load '$fullPath' \n";
        return include_once($fullPath);
    }
    print "Can't load anything for '$namespace' fail on " . $name . " \n";
    return false;
}

function loadPath($absPath) {
//    print "Trying load '$absPath' \n";
    return include_once($absPath);
}

spl_autoload_register(__NAMESPACE__ . '\load');
