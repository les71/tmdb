<?php

function tmdbautoload($class) {
    $file = str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
        return true;
    } else {
        echo "file open error:" . $file;
        return false;
    }
}

spl_autoload_register('tmdbautoload');

$Registry = new helper\Registry();

try {
    $MySQL = new helper\db\mysqli(\config\data::DB_HOST, \config\data::DB_USER, \config\data::DB_PASS, \config\data::DB_NAME, \config\data::DB_PORT);
    $Db = new helper\db\query($MySQL, new helper\db\bind($MySQL));
} catch (\Exception $ex) {
    die("db connect error");
}
