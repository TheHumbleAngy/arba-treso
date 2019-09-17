<?php
    function db_connect() {
        static $connection;

        if (!isset($connection)) {
            $config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/credentials/config.ini');
            $connection = mysqli_connect($config['hostname'], $config['username'], $config['password'], $config['dbname']);
//            require_once ($_SERVER['DOCUMENT_ROOT'] . '/includes/dbconnect.php');
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