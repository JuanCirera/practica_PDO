<?php

namespace App;

use PDO;
use PDOException;

class Autor extends Conexion{

    private int $id;
    private string $nombre;
    private string $apellidos;

    public function __construct()
    {
        parent::__construct();
    }

    // ------ CRUD

    public function create(){
        $q="insert into autores(nombre,apellidos) values(:n,:a)";
        $stmt=parent::$conexion->prepare($q);

        try{
            $stmt->execute([
                ":n"=>$this->nombre,
                ":a"=>$this->apellidos
            ]);
        }catch(PDOException $e){
            die("Error en create (autores): ".$e->getMessage());
        }

        parent::$conexion=null;
    }

    public static function read(bool $id=null){
        parent::crearConexion();
        $q=($id==null)?"select * from autores":"select id_autor from autores";
        $stmt=parent::$conexion->prepare($q);

        try{
            $stmt->execute();
        }catch(PDOException $e){
            die("Error en read (autores): ".$e->getMessage());
        }
        
        parent::$conexion=null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(int $id){
        $q="update from autores set nombre=:n, apellidos=:a where id=:i";
        $stmt=parent::$conexion->prepare($q);

        try{
            $stmt->execute([
                ":n"=>$this->nombre,
                ":a"=>$this->apellidos,
                ":i"=>$id
            ]);
        }catch(PDOException $e){
            die("Error en update (autores): ".$e->getMessage());
        }
        
        parent::$conexion=null;
    }

    public function delete(int $id){
        $q="delete from autores where id=:i";
        $stmt=parent::$conexion->prepare($q);

        try{
            $stmt->execute([
                ":i"=>$id
            ]);
        }catch(PDOException $e){
            die("Error en delete (autores): ".$e->getMessage());
        }
        
        parent::$conexion=null;
    }


    // ------ Metodos

    public static function crearAutores(int $cant){
        if(self::hayAutores()) return;

        $faker=\Faker\Factory::create("es_ES");

        for($i=0;$i<$cant;$i++){
            (new Autor)
            ->setNombre($faker->firstName())
            ->setApellidos($faker->lastName())
            ->create();
        }
    }

    private static function hayAutores(){
        parent::crearConexion();

        $q="select id_autor from autores";
        $stmt=parent::$conexion->prepare($q);

        try{
            $stmt->execute();
        }catch(PDOException $e){
            die("Error en hayAutores: ".$e->getMessage());
        }

        parent::$conexion=null;
        return $stmt->rowCount();
    }


    // ------ Setters

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Set the value of apellidos
     *
     * @return  self
     */ 
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}