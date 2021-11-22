<?php

namespace App\Models;

use App\Model;

class Adresse extends Model
{

	/*private $id_pers;
		private $adr_voie;
		private $adr_cp;
		private $adr_ville;
		private $id_adr;*/

	public $id_pers;
	public $adr_voie;
	public $adr_cp;
	public $adr_ville;
	public $id_adr;

	public function __construct()
	{

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
	 * function pour inserer un element dans la DB and return:
	 * 1 : L'adresse a été ajoutée avec success
	 * 0 : Erreur d'insertion
	 * -1 : Erreur champs vides
	 */
	public function insertAdr()
	{
		if (
			!empty(trim($this->id_pers)) &&
			!empty(trim($this->adr_voie)) &&
			!empty(trim($this->adr_cp)) &&
			!empty(trim($this->ville))
		) {

			$req = $this->_connexion->prepare("CALL inserer_addresse(NULL,'$this->adr_voie','$this->adr_cp','$this->adr_ville')");
			$state = $req->execute();
			if ($state) {
				return 1;
			} else {
				return 0;
			}
		} else {
			return -1;
		}
	}

	/**
	 * function pour inserer un element dans la DB and return:
	 * 1 : L'adresse a été ajoutée avec success
	 * 0 : Erreur d'insertion
	 * -1 : Erreur champs vides
	 */

	public function ajouter_adresse($id_pers, $adr_voie, $adr_cp, $adr_ville){
		
		if(!empty($id_pers) && !empty($adr_voie) && !empty($adr_cp) && !empty($adr_ville)){
			$id_pers = (int)$id_pers;
			$req = $this->_connexion->prepare("CALL inserer_addresse('$id_pers','$adr_voie','$adr_cp','$adr_ville')");
			$state = $req->execute();
			if($state){
				return 1;
			}else{
				return 0;			}
		}else{
			return -1;
		}
	}
	


	/**
	 * function pour update un element dans la base de donnes 
	 * and return
	 * 1 :  L'adresse a été ajoutée avec success
	 * 0 : Erreur d'insertion
	 * -1 : Erreur champs vides
	 */

	public function updateAdr()
	{

		if (
			!empty(trim($this->id_pers)) &&
			!empty(trim($this->adr_voie)) &&
			!empty(trim($this->adr_cp)) &&
			!empty(trim($this->ville))
		) {

			$id_pers = (int)$this->id_pers;
			$state = $this->_connexion->update("CALL modifier_adresse('$this->id_adr','$this->id_pers','$this->adr_voie','$this->adr_cp','$this->adr_ville')");

			if ($state) {
				return 1;
			} else {
				return 0;
			}
		} else {
			return -1;
		}
	}

	public function getId_pers()
	{
		return $this->id_pers;
	}

	public function getAdrVoie()
	{
		return $this->adr_voie;
	}

	public function getAdrCP()
	{
		return $this->adr_cp;
	}

	public function getAdrVille()
	{
		return $this->adr_ville;
	}
}
