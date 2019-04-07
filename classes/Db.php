<?php

    abstract class Db {
        private static $conn;

        public static function getInstance(){
            $config = parse_ini_file("config/config.ini");//linken met je ini file

            if( self::$conn != null){
                return self::$conn; 
            } //gaat niet den heletijd connecteren, gaat 1 keer connecteren en gebruikt die connectie voor de volgende in plaats van
              //opnieuw te connecteren
            else{
                self::$conn = new PDO("mysql:host=localhost;".$config['db_name'], $config["db_user"],$config["db_password"],NULL);
                //$this verwijst naar huidig object , self naar zichzelf
                return self::$conn;
            }
            
        }
    }