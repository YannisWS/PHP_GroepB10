<?php
  abstract class Db {
    private static $conn;

    public static function getConfig(){
        return parse_ini_file(__DIR__ . "/../config/config.ini");
    }

    public static function getInstance(){
      if(self::$conn != null){
        return self::$conn;
      }else{
        $config = self::getConfig();
        self::$conn = new PDO('mysql:host=localhost;dbname='.$config['database'], $config['user'], $config['password']);
        return self::$conn;
      }
    }
  }
