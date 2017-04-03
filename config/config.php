<?php

//DATABASE CONFIGURATION

define('DB_HOST', "localhost");

define('DB_TYPE', "mysql");

define('DB_USER', "root");

define('DB_PASS', "");

define('DB_NAME', "login");

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => DB_HOST,
        'username' => DB_USER,
        'password' => DB_PASS,
        'db' => DB_NAME
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);
