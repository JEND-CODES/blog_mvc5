<?php

//Connexion à la base de données

//A placer dans le Modèle : cette partie gère les données de votre site. Son rôle est d'aller récupérer les informations « brutes » dans la base de données, de les organiser et de les assembler pour qu'elles puissent ensuite être traitées par le contrôleur. On y trouve donc entre autres les requêtes SQL.

//Retravailler la protection de la connexion ??

class Database
{
	
    protected function connectDB()
    {
    
    	$db = new PDO('mysql:host=localhost;dbname=bootmvc30;charset=utf8', 'root', '');
        
    	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //gère le type d'erreurs lors de la connexion à la BDD - l'option ERRMODE_SILENT est l'option par défaut qui assigne simplement les messages d'erreurs (ERRMODE_SILENT - voir la documentation MySQL)
        //PDO::ATTR_ERRMODE : renvoie un rapport d'erreurs
        
        $db->setAttribute(PDO::FETCH_ASSOC, false);
        // PDO::FETCH_ASSOC -> Chaque entrée sera récupérée et placée dans un array
        
    	return $db;
    }
}

    // Ajouter ERRMODE SILENT ?? et PDO FETCH ASSOC ?? dans le setAttribute ?

//$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

    

// ajout d'un try catch die ??

//pour afficher un message d'erreur lorsque l'on n'est pas connecté à une bdd existante ??

//On essaie de se connecter à la base de données dans le bloc  try . Si tout va bien, on continue (on va dans le "Code après"). Si en revanche il y a un souci lors de la connexion (à l'intérieur du new PDO), alors on récupère l'erreur dans le bloc catch
    
