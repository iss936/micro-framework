<?php

namespace App\core\db;


class DB extends \PDO{

	protected $connexion;
	
	public function __construct(){
		include_once __DIR__."/../../config/settings.php";
		
		try{
			parent::__construct($settings['pdo_db_type'].":dbname=".$settings['db_name'].";host=".$settings['db_host'], $settings['db_username'], $settings['db_password']);
			$this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		} catch (PDOException $e) {
			echo 'Connexion échouée : '.$e->getMessage();
		}
	}

	public function _destruct(){
		$this->connexion = null;
	}

}
