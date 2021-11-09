<?php

	require_once "DBconnect.php";
	
	class Produit{
		
		private $ref_prod;
		private $id_cat;
		private $id_pers;  // identifiant du prestataire ou vendeur
		private $labels;
		private $prix;
		private $quantite;
		private $description;
		private $image_prod;
		
		public function __construct($ref, $id_cat, $id_pers, $labels, $prix, $quantite, $description, $image_prod){
			
			$this->ref_prod = $ref;
			$this->id_cat = $id_cat;
			$this->id_pers = $id_pers;
			$this->labels = $labels;
			$this->prix = $prix;
			$this->quantite = $quantite;
			$this->description = $description;
			$this->image_prod = $image_prod;
			
			$db = new Database();
			
		}

		
		
		public function ajouter_produit($ref, $id_cat, $id_pers, $labels, $prix, $quantite, $description, $image_prod){
			
			if(!empty(trim($id_pers)) && !empty(trim($id_cat)) && !empty(trim($ref)) && !empty(trim($labels)) && !empty(trim($prix)) && !empty(trim($quantite)) && !empty(trim($description)) && !empty(trim($image_prod))){
				$id_cat = (int)$id_cat;
				$id_pers = (int)$id_pers;
				$prix = (int)$prix;
				$quantite = (int)$quantite;
				$state = $db->insert("CALL ajouter_produit_par_categorie('$ref', '$id_cat', '$id_pers', '$labels', '$prix', '$quantite', '$description', '$image')");
				if($state){
					echo "Le Produit a été ajouté avec success";
				}else{
					echo "Erreur d'insertion";
				}
			}else{
				echo "Erreur champs vide";
			}
			
			
		}
		
		
		public function afficher_produit($id_cat){
			$id_cat = (int)$id_cat;
			$result = $db->query("CALL liste_produits_categories('$id_cat')");
			var_dump($result);
			return $result;
		}
		
		
		public function modifier_produit($ref, $id_cat, $id_pers, $labels, $prix, $quantite, $description, $image){
			if(!empty(trim($labels)) && !empty(trim($prix)) && !empty(trim($quantite)) && !empty(trim($description)) && !empty(trim($image)) ){
				$id_cat = (int)$id_cat;
				$id_pers = (int)$id_pers;
				$prix = (int)$prix;
				$quantite = (int)$quantite;
				$state = $db->update("CALL modifier_produit('$ref','$id_cat','$id_pers','$labels','$prix','$quantite','$description','$image')");
				if($state){
					echo "Le produit a été modifié avec success";
				}else{
					echo "Erreur de modifications";
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




?>