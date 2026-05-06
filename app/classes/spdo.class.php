<?php

class SPDO
{
	private $pdoInstance;
	private $erreur;
	private $codeErreur;

	public function __construct()
	{
		try {
			$this->pdoInstance = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NOMBASE . ";charset=utf8", DB_USER, DB_PWD);
		} catch (PDOException $e) {
			$this->erreur = $e->getMessage();
			$this->codeErreur = $e->getCode();
		}
	}

	public function getPDOInstance()
	{
		return $this->pdoInstance;
	}

	public function setPDOInstance($pdoInstance)
	{
		$this->pdoInstance = $pdoInstance;
	}

	public function getErreur()
	{
		return $this->erreur;
	}

	public function setErreur($erreur)
	{
		$this->erreur = $erreur;
	}

	public function getCodeErreur()
	{
		return $this->codeErreur;
	}

	public function setCodeErreur($codeErreur)
	{
		$this->codeErreur = $codeErreur;
	}

	public function quote($datas)
	{
		return $this->pdoInstance->quote($datas);
	}

	public function lastInsertId()
	{
		return $this->pdoInstance->lastInsertId();
	}

	public function query($requete)
	{
		try {
			$this->pdoInstance->query($requete);
		} catch (PDOException $e) {
			$this->erreur = $e->getMessage();
			$this->codeErreur = $e->getCode();
		}
	}

	public function qfetch($requete)
	{
		try {
			$datas =  $this->pdoInstance->query($requete)->fetchAll();

			return $datas;
		} catch (PDOException $e) {
			$this->erreur = $e->getMessage();
			$this->codeErreur = $e->getCode();
		}
	}
}