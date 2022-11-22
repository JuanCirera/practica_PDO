<?php

namespace App;

use \Dotenv;
use PDO;
use PDOException;

class Conexion{

    protected static $conexion;

    public function __construct()
    {
        self::crearConexion();
    }

    public static function crearConexion(){
        if(self::$conexion!=null) return;

        $dotenv=Dotenv\Dotenv::createImmutable(__DIR__."/../");
        $dotenv->load();

        $user=$_ENV["USER"];
        $passwd=$_ENV["PASSWD"];
        $host=$_ENV["HOST"];
        $db=$_ENV["DATABASE"];

        $dsn="mysql:host=$host;dbname=$db;charset=utf8mb4";

        $opciones=[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION];

        try{
            self::$conexion=new PDO($dsn, $user, $passwd, $opciones);
        }catch(PDOException $e){
            die("Error en conexion: ".$e->getMessage());
        }

    }
}