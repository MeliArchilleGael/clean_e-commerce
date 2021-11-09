<?php

	require_once "DBconnect.php";
	
	class Personne{

		protected $id_pers;
		protected $nom_pers;
		protected $prenom_pres;
		protected $telephone;
		protected $email;
		protected $image_pers;
		protected $type_pers;
		protected $password;
		
		public function __construct($id = 0, $nom, $prenom, $phone, $email, $image, $type_pers, $password){
			
			$this->id_pers = $id;
			$this->nom_pers = $nom;
			$this->prenom_pres = $prenom;
			$this->telephone = $phone;
			$this->email = $email;
			$this->image_pers = $image;
			$this->type_pers = $type_pers;
			$this->password = $password;
			
			$db = new Database();
		}
		
		public function afficher_user($email){
			
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo "L'adresse email '$email' est valide.";
				$result = $db->query_one("CALL afficherID_user('$email')");
				return $result;
			}else{
				echo "L'adresse email '$email' est invalide.";
			}
			
		}
		
		public function getIdPers(){
			return $this->id_pers;
		}
		
		public function getNom(){
			return $this->nom_pers;
		}
		
		public function getPrenom(){
			return $this->prenom_pres;
		}

		public function getPhone(){
			return $this->telephone;
		}
		
		public function getEmail(){
			return $this->email;
		}
		
		public function getTypePers(){
			return $this->type_pers;
		}
		
		public function getImage(){
			return $this->image_pers;
		}

		public function getPassword(){
			return $this->password;
		}

		

	}




?>