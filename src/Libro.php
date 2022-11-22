<?php

namespace App;

use Auto;
use PDO;
use PDOException;

class Libro extends Conexion{

    private int $id;
    private string $titulo;
    private string $isbn;
    private int $autor;
    private string $portada;

    public function __construct()
    {
        parent::__construct();
    }


    // ------ CRUD

    public function create(){
        $q="insert into libros(titulo,isbn,autor,portada) values(:t,:i,:a,:p)";
        $stmt=parent::$conexion->prepare($q);

        try{
            $stmt->execute([
                ":t"=>$this->titulo,
                ":i"=>$this->isbn,
                ":a"=>$this->autor,
                ":p"=>$this->portada
            ]);
        }catch(PDOException $e){
            die("Error en create (libros): ".$e->getMessage());
        }

        parent::$conexion=null;
    }

    public static function read(){
        parent::crearConexion();
        $q="select * from libros";
        $stmt=parent::$conexion->prepare($q);

        try{
            $stmt->execute();
        }catch(PDOException $e){
            die("Error en read (libros): ".$e->getMessage());
        }
        
        parent::$conexion=null;
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function update(int $id){
        $q="update from libros set titulo=:t, isbn=:i, autor=:a, portada=:p where id=:i";
        $stmt=parent::$conexion->prepare($q);

        try{
            $stmt->execute([
                ":t"=>$this->titulo,
                ":i"=>$this->isbn,
                ":a"=>$this->autor,
                ":p"=>$this->portada,
                ":i"=>$id
            ]);
        }catch(PDOException $e){
            die("Error en update (libros): ".$e->getMessage());
        }
        
        parent::$conexion=null;
    }

    public function delete(int $id){
        $q="delete from libros where id=:i";
        $stmt=parent::$conexion->prepare($q);

        try{
            $stmt->execute([
                ":i"=>$id
            ]);
        }catch(PDOException $e){
            die("Error en delete (libros): ".$e->getMessage());
        }
        
        parent::$conexion=null;
    }


    // ------ Metodos

    public static function crearLibros(int $cant){
        if(self::hayLibros()) return;

        $faker=\Faker\Factory::create("es_ES");

        //He modificado el read de Autores para que me traiga solo los ids si le paso true
        $autores=Autor::read(true);
        $id_autores=[];
        //Aqui tengo que hacer una ñapa porque al read le dije que devolviera objetos,
        //por lo que tengo que hacer otro array para meter unicamente los id.
        for($i=0;$i<count($autores);$i++){
            $id_autores[$i]=$autores[$i]->id_autor;
        }

        for($i=0;$i<$cant;$i++){
            (new Libro)
            ->setTitulo($faker->word())
            ->setIsbn($faker->isbn13())
            ->setAutor($faker->randomElement($id_autores))
            ->setPortada("img/default.jpg")
            ->create();
        }
    }

    private static function hayLibros(){
        parent::crearConexion();

        $q="select id_libro from libros";
        $stmt=parent::$conexion->prepare($q);

        try{
            $stmt->execute();
        }catch(PDOException $e){
            die("Error en hayLibros: ".$e->getMessage());
        }

        parent::$conexion=null;
        return $stmt->rowCount();
    }


    // ------ Setters

    

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

    /**
     * Set the value of titulo
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Set the value of isbn
     *
     * @return  self
     */ 
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Set the value of autor
     *
     * @return  self
     */ 
    public function setAutor($autor)
    {
        $this->autor = $autor;

        return $this;
    }

    /**
     * Set the value of portada
     *
     * @return  self
     */ 
    public function setPortada($portada)
    {
        $this->portada = $portada;

        return $this;
    }
}