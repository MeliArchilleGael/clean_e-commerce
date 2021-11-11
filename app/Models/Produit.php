<?php
namespace App\Models;

use App\Model;
	
	class Produit extends Model {
		
		/*private $ref_prod;
		private $id_cat;
		private $id_pers;  // identifiant du prestataire ou vendeur
		private $labels;
		private $prix;
		private $quantite;
		private $description;
		private $image_prod;*/

		public $ref_prod;
		public $id_cat;
		public $id_pers;  // identifiant du prestataire ou vendeur
		public $labels;
		public $prix;
		public $quantite;
		public $description;
		public $image_prod;
		
		public function __construct(){
			
			//pour la base de donneé 
			$this->table = 'PRODUIT';
			$this->primaryKey = 'REF_PROD';

			/*
				Avec ceci on etablie la connection a la base de donnée
				et on peut utiliser la variale ($this->_connexion) de la classe mere pour executer les requetes 
			*/
			$this->getConnection();
			
		}

		
		/**
		 * insere un produit et retourne: 
		 * 1 : Le Produit a été ajouté avec success
		 * 0 : Erreur d'insertion
		 * -1 : Erreur champs vide
		 */
		public function ajouter_produit(){
			
			if(!empty(trim($this->id_pers)) && 
			!empty(trim($this->id_cat)) && 
			!empty(trim($this->ref)) && 
			!empty(trim($this->labels)) && 
			!empty(trim($this->prix)) && 
			!empty(trim($this->quantite)) && 
			!empty(trim($this->description)) && 
			!empty(trim($this->image_prod)))
			{
				$id_cat = (int)$this->id_cat;
				$id_pers = (int)$this->id_pers;
				$prix = (int)$this->prix;
				$quantite = (int)$this->quantite;
				$state = $this->_connexion->insert("CALL ajouter_produit_par_categorie('$this->ref_prod', '$id_cat', '$id_pers', '$this->labels', '$prix', '$quantite', '$this->description', '$this->image_prod')");
				if($state){
					return 1;
				}else{
					return 0;
				}
			}else{
				return -1;
			}
			
			
		}
		
		
		public function afficher_produit($id_cat){
			$id_cat = (int)$id_cat;
			$result = $this->_connexion->query("CALL liste_produits_categories('$id_cat')");
			var_dump($result);
			return $result;
		}
		
		/**
		 * Modifie les information du produit et retourne 
		 * 1 : Le produit a été modifié avec success
		 * 0 : Erreur de modifications
		 */
		public function modifier_produit($ref, $id_cat, $id_pers, $labels, $prix, $quantite, $description, $image){
			if(!empty(trim($labels)) && 
			!empty(trim($prix)) && 
			!empty(trim($quantite)) && 
			!empty(trim($description)) && 
			!empty(trim($image)) )
			{
				$id_cat = (int)$id_cat;
				$id_pers = (int)$id_pers;
				$prix = (int)$prix;
				$quantite = (int)$quantite;
				$state = $this->_connexion->update("CALL modifier_produit('$ref','$id_cat','$id_pers','$labels','$prix','$quantite','$description','$image')");
				if($state){
					return 1;
				}else{
					return 0;
				}
			}
		}
		


		public function getRefProd(){
			return $this->ref_prod;
		}
		
		public function getIdCat(){
			return $this->id_cat;
		}
		
		public function getIdPers(){
			return $this->id_pers;
		}
		
		public function getLabels(){
			return $this->labels;
		}
		
		public function getPrix(){
			return $this->prix;
		}
		
		public function getQte(){
			return $this->quantite;
		}
		
		public function getDescription(){
			return $this->description;
		}
		
		public function getImage(){
			return $this->image_prod;
		}
		
		public function setRefProd($ref){
			$this->ref_prod = $ref;
		}
		
		public function setIdCat($id_cat){
			$this->id_cat = $id_cat;
		}
		
		public function setIdPers($id_pers){
			$this->id_pers = $id_pers;
		}
		
		public function setLabels($labels){
			$this->labels = $labels;
		}
		
		public function setPrix($prix){
			$this->prix = $prix;
		}
		
		public function setQte($qte){
			$this->quantite = $qte;
		}
		
		public function setDescription($des){
			$this->description = $des;
		}
		
		public function setImage($image){
			$this->image_prod = $image;
		}
		
		
		

	}
