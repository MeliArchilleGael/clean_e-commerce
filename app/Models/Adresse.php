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
	public function insert()
	{
		if (
			!empty(trim($this->id_pers)) &&
			!empty(trim($this->adr_voie)) &&
			!empty(trim($this->adr_cp)) &&
			!empty(trim($this->ville))
		) {

			$state = $this->_connexion->insert("CALL inserer_addresse(NULL,'$this->adr_voie','$this->adr_cp','$this->adr_ville')");

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
	 * function pour update un element dans la base de donnes 
	 * and return
	 * 1 :  L'adresse a été ajoutée avec success
	 * 0 : Erreur d'insertion
	 * -1 : Erreur champs vides
	 */

	public function update()
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
