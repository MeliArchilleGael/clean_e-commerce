<?php
namespace App\Models;

use App\Model;

	class Categorie extends Model{

		/*private $id_categorie;
		private $nom_categorie;*/
		public $id_categorie;
		public $nom_categorie;
		
		public function __construct(){
			//pour la base de donneé 
			$this->table = 'CATEGORIE';
			$this->primaryKey = 'ID_CAT';

			/*
				Avec ceci on etablie la connection a la base de donnée
				et on peut utiliser la variale ($this->_connexion) de la classe mere pour executer les requetes 
			*/
			$this->getConnection();
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
		
		/**
		 * insert a categorie and 
		 * 1: if success
		 * 0 : Erreur d'insertion
		 * -1: Erreur champs vide
		 */
		public function ajouter_categorie(){
			
			if(!empty(trim($this->nom))){
				
				$state = $this->_connexion->insert("CALL ajouter_categorie('$this->nom')");
				if($state){
					return 1;
					//echo "La catégorie a été ajoutée avec success";
				}else{
					return 0;
				}
			}else{
				return -1;
			}
				
		}
		
		public function afficher_categorie(){
			
			$result = $this->_connexion->query("CALL afficher_categorie()");
			var_dump($result);
			return $result;
		}
		
		/*
		 * requete prenant en parametre le nom de la categorie et retourne l'id categorie
		 * return -1 => Erreur champs vides
		 */ 
		
		public function afficher_nom_categorie($nom){
			
			if (!empty(trim($nom))){
				$result = $this->_connexion->query_one("CALL afficher_categorie_byName('$nom')");
				var_dump($result);
				return $result;
			}else{
				return -1;
			}
		}
		
				
		public function afficher_categorie_byId($id){
			$id = (int)$id;
			$result = $this->_connexion->query_one("CALL afficher_categorie_one('$id')");
			var_dump($result);
			return $result;
		}
		
		
		/*
		* Modifie une categorie et retourne:
		*	1 : La catégorie a été modifiée avec success
		*	0 : Erreur de modification
		*	-1 : Erreur champs vides
		 */
		public function modifier_categorie($id, $nom){
			if(!empty(trim($nom))){
				$id = (int)$id;
				$state = $this->_connexion->update("CALL modifier_categorie('$id','$nom')");
				if($state){
					return 1;
				}else{
					return 0;
				}
			}else{
				return -1;
			}
		}
		

		public function supprimer_categorie($id){
			
			
		}


	}




?>