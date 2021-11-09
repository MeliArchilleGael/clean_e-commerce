<?php
	namespace App\Models;
	use App\Model;
	
	class Adresse extends Model{

		private $id_pers;
		private $adr_voie;
		private $adr_cp;
		private $adr_ville;
		private $id_adr;
		
		public function __construct($id_pers, $adr_voie, $adr_cp, $adr_ville){
			
			$this->id_pers = $id_pers;
			$this->adr_voie = $adr_voie;
			$this->adr_cp = $adr_cp;
			$this->adr_ville = $adr_ville;
			
			//pour la base de donneé 
			$this->table = 'ADDRESSE';
			$this->primaryKey = 'ID_ADDRESSE'; 

			/*
			Avec ceci on etablie la connection a la base de donnée
			et on peut utiliser la variale ($this->_connexion) de la classe mere pour executer les requetes 
			 */
			$this->getConnection();
		}
		
		/**
		 * function pour inserer un element dans la DB
		 */
		public function insert(){
			if(!empty(trim($this->id_pers)) && 
				!empty(trim($this->adr_voie)) && 
				!empty(trim($this->adr_cp)) && 
				!empty(trim($this->ville)))
			{

				$id_pers = (int)$this->id_pers;
				$state = $this->_connexion->insert("CALL inserer_addresse(NULL,'$this->adr_voie','$this->adr_cp','$this->adr_ville')");
				
				if($state){
					echo "L'adresse a été ajoutée avec success";
				}else{
					echo "Erreur d'insertion";
				}
			}else{
				echo "Erreur champs vides";
			}
		}
		
		/**
		 * function pour update un element dans la base de donnes 
		 */
		
		public function update($id_adr, $id_pers, $adr_voie, $adr_cp, $adr_ville){

			if(!empty(trim($this->id_pers)) && 
				!empty(trim($this->adr_voie)) && 
				!empty(trim($this->adr_cp)) && 
				!empty(trim($this->ville)))
			{

				$id_pers = (int)$this->id_pers;
				$state = $this->_connexion->update("CALL modifier_adresse('$this->id_adr','$this->id_pers','$this->adr_voie','$this->adr_cp','$this->adr_ville')");
				
				if($state){
					echo "L'adresse a été ajoutée avec success";
				}else{
					echo "Erreur d'insertion";
				}
			}else{
				echo "Erreur champs vides";
			}
		}

		public function getId_pers(){
			return $this->id_pers;
		}
		
		public function getAdrVoie(){
			return $this->adr_voie;
		}

		public function getAdrCP(){
			return $this->adr_cp;
		}
		
		public function getAdrVille(){
			return $this->adr_ville;
		}
	
	}	


