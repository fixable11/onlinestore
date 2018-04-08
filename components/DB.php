<?php

class DB
{
    
    private static $db;

    private static function db_connect(){

        $paramsPath = ROOT . '/config/db_params.php';
        $params = require($paramsPath);

        if(self::$db === null){

            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
            self::$db = new PDO($dsn, $params['user'], $params['password']);
            self::$db->exec('SET NAMES UTF8');
            self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$db;

    }

    public static function db_query($sql, $params = []){

        $db = self::db_connect();

        $query = $db->prepare($sql);
        $query->execute($params);

        $error = self::db_check_error($query);

        if($error) return $error;

        return $query;

    }

    private static function db_check_error($query){

        $info = $query->errorInfo();

        if($info[0] != PDO::ERR_NONE){

            return $info[2];

        }

    }

}