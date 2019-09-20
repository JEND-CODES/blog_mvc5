<?php 

// Test de remplacement numéro 1

class Database
{

	protected function connect_bdd()
    {
    
    	$db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

    	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    	return $db;
    }
}
