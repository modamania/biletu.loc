<?php

class Db{
    public static function getConnection(){
        $paramsPath = $_SERVER['DOCUMENT_ROOT'].'/config/db_config.php';
        $params = include ($paramsPath);


        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']) or die('Ошибка подключения к базе данных');

        return $db;
    }

}