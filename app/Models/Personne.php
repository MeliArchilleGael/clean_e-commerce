<?php

namespace App\Models;

use App\Model;
use Exception;
use PDOException;

class Personne extends Model
{

	/*protected $id_pers;
	protected $nom_pers;
	protected $prenom_pres;
	protected $telephone;
	protected $email;
	protected $image_pers;
	protected $type_pers;
	protected $password;*/

	public $id_pers;
	public $nom_pers;
	public $prenom_pres;
	public $telephone;
	public $email;
	public $image_pers;
	public $type_pers;
	public $password;

 /* ce contructeur implique de connaitre toute les informations
	d'une personne pour le créee or c'est pas toujours le cas 

		public function __construct($nom, $prenom, $phone, $email, $image=null, $type_pers, $password)
		{

			$this->nom_pers = $nom;
			$this->prenom_pres = $prenom;
			$this->telephone = $phone;
			$this->email = $email;
			$this->image_pers = $image;
			$this->type_pers = $type_pers;
			$this->password = $password;

			//pour la base de donneé 
			$this->table = 'PERSONNE';
			$this->primaryKey = 'ID_PERS';

			
				Avec ceci on etablie la connection a la base de donnée
				et on peut utiliser la variale ($this->_connexion) de la classe mere pour executer les requetes 
			
			$this->getConnection();
		}
 */

	public function __construct(){
		//pour la base de donneé 
		$this->table = 'PERSONNE';
		$this->primaryKey = 'ID_PERS';

		/*
			Avec ceci on etablie la connection a la base de donnée
			et on peut utiliser la variale ($this->_connexion) de la classe mere pour executer les requetes 
		*/
		$this->getConnection();
	}

	
	public function getPersonneByEmail_Password(){
		$sql = "SELECT * FROM ".$this->table." WHERE email = '".$this->email."' AND PASSWORD_USER = '".$this->password."'"; 

        $query = $this->_connexion->prepare($sql);
        $query->execute();

        $rs = $query->fetch();
		
		if($rs){
			
			$this->id_pers = $rs['ID_PERS'];
			$this->nom_pers = $rs['NOM_PERS'];
			$this->prenom_pres = $rs['PRENOM_PERS'];
			$this->telephone = $rs['TELEPHONE'];
			$this->type_pers = $rs['TYPE_USER'];
			$this->image_pers = $rs['IMAGE_PERS'];

		} else {
			return null; 
		}
	}


	// CALL afficherID_user('meliyamtcheuloic@gmail.com','dgfheerttr');

	public function afficher_user($email,$password)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$res = $this->_connexion->prepare("CALL afficherID_user('$email','$password')");
			$res->execute();
			$result = $res->fetch();
			var_dump($result);
			// die();
			return $result;
		} else {
			echo "L'adresse email '$email' est invalide.";
		}
	}


	/**
	 * function pour inserer un element dans la DB and return:
	 * 1 : L'adresse a été ajoutée avec success
	 * 0 : Erreur d'insertion
	 * -1 : Erreur champs vides
	 */

	public function inscription($nom, $prenom, $phone, $email, $image, $type_pers, $password){
			
			$res = $this->_connexion->prepare("CALL ajouter_personne('$nom','$prenom','$email','$password','$phone','$image','$type_pers')");
			
			try {
				$this->_connexion->beginTransaction();
				$state = $res->execute();
				$id = $this->_connexion->lastInsertId();
				//var_dump($id);
				$this->_connexion->commit();
				
			} catch(PDOException $e) {
				$this->_connexion->rollback();
				print "Error!: " . $e->getMessage() . "</br>";
			}

			
			//$id = $this->_connexion->lastInsertId();
			
			if ($state) 
				return 1;
			 else 
				return 0;
	}

	public function order($id_user){
		if(!empty($id_user)){
			$id_user = (int)$id_user;
			try{
				$req = $this->_connexion->prepare("CALL ajouter_commande('$id_user', now())");
				$this->_connexion->beginTransaction();
				$req->execute();
				$sql = "SELECT LAST_INSERT_ID() AS id_cmde";
				$r = $this->_connexion->prepare($sql);
				$r->execute();
				$id_cmde = $r->fetch();
				$state = $this->_connexion->commit();
				// var_dump($state);
				// var_dump($id_cmde["id_cmde"]);
				// die();
			} catch(PDOException $e) {
				$this->_connexion->rollback();
				print "Error!: " . $e->getMessage() . "</br>";
			}
			
			if($state){
				// recuperation de l'identifiant de la commande
				return $id_cmde["id_cmde"];
			}else{
				return 0;
			}

		}else{
			return -1;
		}

	}


	public function order_all($id_cmde,$ref_prod,$qte_cmde,$prix_cmde){
		if(!empty($id_cmde) && !empty($ref_prod) && !empty($qte_cmde) && !empty($prix_cmde)){
			$id_cmde = (int)$id_cmde;
			$qte_cmde = (int)$qte_cmde;
			$prix_cmde = (int)$prix_cmde;
			try{
				$result = $this->_connexion->prepare("CALL inserer_posseder('$id_cmde','$ref_prod','$qte_cmde','$prix_cmde')");
				$this->_connexion->beginTransaction();
				$result->execute();
				$state = $this->_connexion->commit();
			    //var_dump($state);
				//die();
			}catch(PDOException $e){
				$this->_connexion->rollback();
				print "Error!: " . $e->getMessage() . "</br>";
			}
			
			if($state){
				return 1;
			}else{
				return 0;
			}

		}else{
			return -1;
		}

	}

	public function update_stock($id_cmde,$ref_prod){
		if (!empty($id_cmde) && !empty($ref_prod)){
			$id_cmde = (int)$id_cmde;
			$res = $this->_connexion->prepare("CALL update_stock_produit('$id_cmde','$ref_prod')");
			$state = $res->execute();
			if ($state){
				return 1;
			}else{
				return 0;
			}
		}else{
			return -1;
		}
	}

	
	public function getIdPers()
	{
		return $this->id_pers;
	}

	public function getNom()
	{
		return $this->nom_pers;
	}

	public function getPrenom()
	{
		return $this->prenom_pres;
	}

	public function getPhone()
	{
		return $this->telephone;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getTypePers()
	{
		return $this->type_pers;
	}

	public function getImage()
	{
		return $this->image_pers;
	}

	public function getPassword()
	{
		return $this->password;
	}
}
