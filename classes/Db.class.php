<?php
    abstract class Db {
        private static $conn;
         public static function getInstance(){
            if(self::$conn != null){
                return self::$conn;
        }else{
            $config = parse_ini_file("config/config.ini");
            self::$conn = new PDO('mysql:host=localhost;dbname='.$config['database'], $config['user'], $config['password']);
            return self::$conn;
            }
        }
    }