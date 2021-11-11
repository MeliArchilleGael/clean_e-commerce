<?php

namespace App\Models;

	
	class Client extends Personne{

		
		public function __construct(){
			
			parent::__construct();

		}
		
		 /* Validation d'adresses email avec un regex */

		/*	$masque = "/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,4}$/";

			if(preg_match($masque, $email))  {
				echo "L'adresse email '$email' est valide.";
			} else {
				echo "L'adresse email '$email' est invalide.";
			}
			
		*/	
		
		public function login($email, $password){
			
			if(!empty(trim($email)) && !empty(trim($password))){
				if(strlen(trim($password)) >= 6){
					$passwordCrypt =  md5("mamy87".$password."papy15");
					
					/* Validation d'adresses email avec filter_var () */
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						echo "L'adresse email '$email' est valide.";
						
						$req = $this->_connexion->query_one("se_connecter('$email','$passwordCrypt')");
						 var_dump($req);
						 
						 return $req;
						 
					} else {
						echo "L'adresse email '$email' est invalide.";
					}
				}else{
					echo "Password must have atleast 6 characters.";					
				}
				
			}else{
				echo "Erreur champs vides";
			}
		}
		
		
		public function inscription($nom, $prenom, $phone, $email, $image, $type_pers, $password){
			
			if(!empty(trim($nom)) && !empty(trim($prenom)) && !empty(trim($phone)) && !empty(trim($email)) && !empty(trim($image)) && !empty(trim($type_pers)) && !empty(trim($password))){
				if(strlen(trim($password)) >= 6){
					
					/* Validation d'adresses email avec filter_var () */
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						echo "L'adresse email '$email' est valide.";
					
						$state = $this->_connexion->insert("CALL ajouter_personne('$nom','$prenom','$email','$password','$phone','$image','$type_pers')");
						if($state){
							echo "La catégorie a été ajoutée avec success";
						}else{
							echo "Erreur d'insertion";
						}
					}else{
						echo "L'adresse email '$email' est invalide.";
					}
				}else{
					echo "Password must have atleast 6 characters.";	
				}
			}else{
				echo "Erreur champs vides";
			}
			
		}
		
		
		public function afficher_client($id){
			
			
		}
		
		public function modifier_profil($id, $nom, $prenom, $email, $password, $phone, $image ){
			if(!empty(trim($nom)) && !empty(trim($prenom)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($image))){
				
				if(strlen(trim($password)) >= 6){
					
					/* Validation d'adresses email avec filter_var () */
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						echo "L'adresse email '$email' est valide.";
						$id = (int)$id;
						$state = $this->_connexion->update("CALL modifer_profil_user('$id','$nom','$prenom','$email','$password','$phone','$image')");
						if($state){
							echo "Modification effectuée avec success";
						}else{
							echo "Erreur de modification";
						}
					}else{
						echo "L'adresse email '$email' est invalide.";
					}
					
				}else{
					echo "Password must have atleast 6 characters.";
				}

			}
			
		}
		
		
		public function deconnexion(){
			
		}
		
		
		// ajouter_commande(IN _id_user INT, IN _date_cmde DATETIME)
		
		public function ajouter_commande(){
			
				
		}
		
		


	}
