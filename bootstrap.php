<?php
  spl_autoload_register(function($class){
      require_once(__DIR__ . DIRECTORY_SEPARATOR . "classes" . DIRECTORY_SEPARATOR . $class . ".class.php");
      ini_set('display_errors',1); error_reporting(E_ALL);//errors
  });
