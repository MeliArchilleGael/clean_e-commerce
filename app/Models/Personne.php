<?php

namespace App\Models;

use App\Model;

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




	public function afficher_user($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "L'adresse email '$email' est valide.";
			$result = $this->_connexion->query_one("CALL afficherID_user('$email')");
			return $result;
		} else {
			echo "L'adresse email '$email' est invalide.";
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
