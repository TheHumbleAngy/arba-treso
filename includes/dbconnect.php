<?php
    ini_set("log_errors", 1);
    ini_set("display_errors", 1); // TODO: Update to 0 in production
    ini_set("error_log", dirname(__FILE__) . "/db_error.log");
    error_reporting(E_ALL);

    function db_connect() {
        static $connection;

        if (!isset($connection)) {
            $config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/credentials/config.ini');
            $connection = mysqli_connect($config['hostname'], $config['username'], $config['password'], $config['dbname']);
        }

        if ($connection === false)
            return mysqli_connect_error();

        return $connection;
    }

    try {
        $connection = db_connect();
    } catch (Exception $e) {
        error_log($e->getMessage());
        exit('Error connecting to database');
    }