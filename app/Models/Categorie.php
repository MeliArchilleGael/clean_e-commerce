<?php

	require_once "DBconnect.php";
	
	class Categorie{

		private $id_categorie;
		private $nom_categorie;
		
		public function __construct($id = 0, $nom){
			
			$this->id_categorie = $id;
			$this->nom_categorie = $nom;
			
			$db = new Database();
		}
		
		public function getNomCategorie(){
			
			return $this->nom_categorie;
		}
		
		public function getIdCategorie(){
				
				return $this->id_categorie;
		}
		
		public function setNomCategorie($nom){
			$this->nom_categorie = $nom;
		}
		
		public function setIdCategorie($id){
			$this->id_categorie = $id;
		}
		
		public function ajouter_categorie($nom){
			
			if(!empty(trim($nom))){
				
				$state = $db->insert("CALL ajouter_categorie('$nom')");
				if($state){
					echo "La catégorie a été ajoutée avec success";
				}else{
					echo "Erreur d'insertion";
				}
			}else{
				echo "Erreur champs vide";
			}
				
		}
		
		public function afficher_categorie(){
			
			$result = $db->query("CALL afficher_categorie()");
			var_dump($result);
			retunr $result;
		}
		
		// requete prenant en parametre le nom de la categorie et retourne l'id categorie
		
		public function afficher_nom_categorie($nom){
			
			if (!empty(trim($nom))){
				$result = $db->query_one("CALL afficher_categorie_byName('$nom')");
				var_dump($result);
				return $result;
			}else{
				echo "Erreur champs vides";
			}
		}
		
				
		public function afficher_categorie_byId($id){
			$id = (int)$id;
			$result = $db->query_one("CALL afficher_categorie_one('$id')");
			var_dump($result);
			retun $result;
		}
		
		
		
		public function modifier_categorie($id, $nom){
			if(!empty(trim($nom))){
				$id = (int)$id;
				$state = $db->update("CALL modifier_categorie('$id','$nom')");
				if($state){
					echo "La catégorie a été modifiée avec success";
				}else{
					echo "Erreur de modification";
				}
			}else{
				echo "Erreur champs vides";
			}
		}
		

		public function supprimer_categorie($id){
			
			
		}


	}




?>