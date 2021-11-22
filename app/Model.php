<?php
//namespace app\Models;
namespace App;

use PDO;

abstract class Model {
    //information de connection
    private $host = "localhost";
    private $user_name = "root";
    private $db_name = "e_commerce";
    private $password = "";

    //proprites contenant les informations de la connection
    protected $_connexion ;

    //proprites contenant des informations de la requete 
    public $table;
    public $id;
    public $primaryKey = 'id';
    public $structure; #A named array containing the fields on the table

    /**
     * function de connection a la base de donnee
    */ 
    public function getConnection(){
        $this->_connexion = null;

        try{
            $this->_connexion = new \PDO('mysql:host=' . $this->host . ';dbname='. $this->db_name, $this->user_name, $this->password);
            $this->_connexion->exec('set names utf8');
    
        } catch(\PDOException $e){
            echo ("Erreur :".$e->getMessage());
        }
    }
    
    /**
     * fonction qui permet de creer la structure de la table 
     */
    public function createTable(){
        //This Function uses the $structure to create a table
        $sql = "CREATE TABLE IF NOT EXISTS `{$this->table}` (";
        $first = true; //Used in the loop to know if the first field has been processed, to prevent putting commas in the wrong area
        foreach ($this->structure as $field => $type){
            $sql .=  ($first ? '' : ',') . "`$field` $type";
            $first = false;
        }
        $sql .= ")";
        $this -> _connexion -> exec($sql);
        
    }


    /**
     * get all instace of the object
     * @return 
     */
    public function getAll() {
        $sql = "SELECT * FROM ".$this->table;
        $query = $this->_connexion->prepare($sql);
        $query->execute();    
            
        return $query->fetchAll();
    }
    
    /***
     * get a specific instance of the object 
     */
    public function getOne(){
        $sql = "SELECT * FROM ".$this->table." WHERE ".$this->primaryKey." = '".$this->id."'"; 
//var_dump($sql);
        $query = $this->_connexion->prepare($sql);
        $query->execute();

        return $query->fetch();
    }


    public function query($sql){

        $req = $this->_connexion->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
    
    public function query_one($sql){
        
        $req = $this->_connexion->prepare($sql);
        $req->execute();
        return $req->fetch();
    }
    
    public function insert($sql){
        $req = $this->_connexion->prepare($sql); 
        return $req->execute();
    }
    
    public function update($sql){
        $req = $this->_connexion->prepare($sql); 
        return $req->execute();
        
    }
    
    public function supprimer($sql){
        $req = $this->_connexion->prepare($sql); 
        return $req->execute();
    }
    


    

}