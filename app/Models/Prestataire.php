<?php
namespace App\Models;

	
	class Prestataire extends Personne{

		public function __construct(){
			
			parent::__construct();
			
		}
		
		
		public function login($email, $password){
			
			if(!empty(trim($email)) && !empty(trim($password))){
				if(strlen(trim($password)) >= 6){
					$passwordCrypt =  md5("mamy87".$password."papy15");
					
					/* Validation d'adresses email avec filter_var () */
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						echo "L'adresse email '$email' est valide.";
						
						$res = $this->_connexion->prepare("se_connecter('$email','$passwordCrypt')");
						$res->execute();
						$req = $res->fetch();
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
					
						$res = $this->_connexion->prepare("CALL ajouter_personne('$nom','$prenom','$email','$password','$phone','$image','$type_pers')");
						$state = $res->execute();
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
		
		
		public function modifier_profil($id, $nom, $prenom, $email, $password, $phone, $image ){
			if(!empty(trim($nom)) && !empty(trim($prenom)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($image))){
				
				if(strlen(trim($password)) >= 6){
					
					/* Validation d'adresses email avec filter_var () */
					if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
						echo "L'adresse email '$email' est valide.";
						$id = (int)$id;
						$res = $this->_connexion->prepare("CALL modifer_profil_pres('$id','$nom','$prenom','$email','$password','$phone','$image')");
						$state = $res->execute();
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
				
		
		

	}
