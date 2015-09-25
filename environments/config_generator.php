#! /usr/bin/env php
<?php

function getParams()
{
    $rawParams = [];
    if (isset($_SERVER['argv'])) {
        $rawParams = $_SERVER['argv'];
        array_shift($rawParams);
    }

    $params = [];
    foreach ($rawParams as $param) {
        if (preg_match('/^--(\w+)(=(.*))?$/', $param, $matches)) {
            $name = $matches[1];
            $params[$name] = isset($matches[3]) ? $matches[3] : true;
        } else {
            $params[] = $param;
        }
    }
    return $params;
}

$params    = getParams();
/*******************    DEFAULT SETTINGS  ***************************/
$rootDir      = !empty($params['root']) ? $params['root'] : __DIR__;
$logDir       = dirname($rootDir);
$nginxTplPath = implode(DIRECTORY_SEPARATOR, [__DIR__, 'nginx.tpl']);
$fpmTplPath   = implode(DIRECTORY_SEPARATOR, [__DIR__, 'php5-fpm.tpl']);
$projectName  = basename($rootDir);
/*******************    DEFAULT SETTINGS  ***************************/
$params['root']         = !empty($params['root']) ? $params['root'] : $rootDir;
$params['project_name'] = !empty($params['project_name']) ? $params['project_name'] : $projectName;
$logDir                 = !empty($params['log']) ? $params['log'] : $logDir;
$params['access_log']   = "access_log $logDir/$projectName.access.log; # main buffer=50k;";
$params['error_log']    = "error_log $logDir/$projectName.error.log warn;";

$nginxTpl = file_get_contents($nginxTplPath);

foreach ($params as $key => $val) {
    $nginxTpl = str_replace("[:$key:]", $val, $nginxTpl);
}

file_put_contents(implode(DIRECTORY_SEPARATOR, [__DIR__, 'nginx.conf']), $nginxTpl);
