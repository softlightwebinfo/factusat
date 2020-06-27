<?php
/*
 * -------------------------------------
 * www.smartyhelpers.com
 * Framework 1.0.0 CWeb
 * Autoload.php
 * -------------------------------------
 */

function autoloadCore($class)
{
    if (file_exists(APP_PATH . ucfirst(($class)) . ".php")) {
        include_once APP_PATH . ucfirst(($class)) . ".php";
    }
}

function autoloadLibs($libs)
{
    if (file_exists(ROOT . 'libs' . DS . ucfirst(($libs)) . ".php")) {
        include_once ROOT . 'libs' . DS . ucfirst(($libs)) . ".php";
    }
}


function autoloadGlobals($model)
{
    if (file_exists(ROOT . 'global' . DS . strtolower($model) . '/' . ucfirst(strtolower($model)) . ".php")) {
        include_once ROOT . 'global' . DS . strtolower($model) . '/' . ucfirst(strtolower($model)) . ".php";
    }
}

function autoloadModels($model)
{
    if (file_exists(ROOT . 'models' . DS . ucfirst(($model)) . ".php")) {
        include_once ROOT . 'models' . DS . ucfirst($model) . ".php";
    }
}

function autoloadEntity($model)
{
    if (file_exists(ROOT . 'entity' . DS . ucfirst(($model)) . ".php")) {
        include_once ROOT . 'entity' . DS . ucfirst($model) . ".php";
    }
}

function autoloadImplements($model)
{
    if (file_exists(ROOT . 'implements' . DS . ucfirst(($model)) . ".php")) {
        include_once ROOT . 'implements' . DS . ucfirst($model) . ".php";
    }
}

function autoloadControllers($model)
{
    if (file_exists(ROOT . 'controllers' . DS . (($model)) . ".php")) {
        include_once ROOT . 'controllers' . DS .($model) . ".php";
    }
}

spl_autoload_register("autoloadCore");
spl_autoload_register("autoloadLibs");
spl_autoload_register("autoloadGlobals");
spl_autoload_register("autoloadEntity");
spl_autoload_register("autoloadModels");
spl_autoload_register("autoloadImplements");
spl_autoload_register("autoloadControllers");