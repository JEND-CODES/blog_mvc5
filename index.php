<?php

// La page Index sert de router 
// La page appelle les classes et les fonctions des Controllers
// La page Index sert aussi de chargement des classes Models 
// Le fichier index.php sert à opérer les redirections pour le bon fonctionnement du blog

// dirname — Renvoie le chemin du dossier parent

define('ROOT', dirname(__FILE__));

// "define root dirname.." signifie "donne moi l'URL du fichier"
// "ROOT" signifie le dossier qui contient toute l'application

$self = htmlentities($_SERVER['PHP_SELF']);

// "define URL.." permet de définir le chemin de la racine -> la variable 'URL' est utilisée dans les vues pour établir un lien de redirection vers la page d'accueil

// Ici le str_replace remplace/masque la mention index.php en page d'accueil du site

define('URL', str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$self"));

// $_SERVER est un tableau contenant des informations comme les en-têtes, dossiers et chemins du script

// PHP ne sait pas qu'il doit appeler une fonction lorsqu'on essaye d'instancier une classe non déclarée. On va donc utiliser la fonction spl_autoload_register en spécifiant en premier paramètre le nom de la fonction à charger //cf.tuto OpenC https://openclassrooms.com/fr/courses/1665806-programmez-en-oriente-objet-en-php/1666060-utiliser-la-classe //Les classes sont chargées dynamiquement avec la fonction spl_autoload_register

// Appel de toutes les classes du fichier Models :

spl_autoload_register(function($modelClass){
    require('models/' .$modelClass. '.php');
});

// Contrôle de l'affichage des pages :
try
{
    //Appel des pages via les fichiers controllers
    if(isset($_GET['action']))
    {
        if(file_exists('controllers/controller' . ucfirst($_GET['action']) . '.php')) {
            require_once('controllers/controller' . ucfirst($_GET['action']) . '.php');
        }
        //https://www.php.net/manual/fr/function.ucfirst.php
            
        else {
            throw new Exception('');
        } 
       
        $pages  = "test|biographie|change|chapitre|commentaires|connect|edit|home|login|nosession|password|slider|sommaire|statistiques";
        
        $surf = explode("|", $pages);
        
        // Instanciation des Controllers
        // Appel des classes et des fonctions des controllers
        // Adoption de la méthode switch/case..
        
        // Plutôt que de réécrire à chaque fois les noms de classes pour l'instanciation, il suffit d'ajouter un numéro lors de la création de nouvelles pages..
        
        
        switch ($_GET['action']) {
            
            case $surf[0]:
                
                // Par exemple :
                $className = ucfirst($surf[0]);
                // -> met biographie en majuscule (la norme pour l'écriture du nom de classe), puis...
                
                $class = 'Controller'.$className;
                // -> remplace ControllerBiographie
                        
                $instance_0 = new $class();
                // -> remplacement pour l'instanciation (comme si on écrivait $controllerBiographie = new ControllerBiographie();) 
                
                $instance_0->{$className}();
                // -> remplacement pour l'appel de la fonction (comme si on écrivait $controllerBiographie->Biographie())
                
                break;
                
                // -> Idem pour les autres Controllers..
                
                // Puisque le nom de classe porte le nom du fichier Controller, lors de l'ajout d'une nouvelle page, il suffit de créer la vue et son Controller, puis d'instancier celui-ci en ajoutant un numéro supplémentaire ($surf[?] et $instance_?)
                
                // Bien veiller qu'il y ait au moins un nombre de "case" au moins équivalent au nombre de fichiers Controllers (en partant de l'index 0,1,2,3,4...) voir note suivante..
                
            case $surf[1]:
                $className = ucfirst($surf[1]);
                $class = 'Controller'.$className;  
                $instance_1 = new $class();
                $instance_1->{$className}();
                break;

            case $surf[2]:
                $className = ucfirst($surf[2]);
                $class = 'Controller'.$className;  
                $instance_2 = new $class();
                $instance_2->{$className}();
                break;
                
            case $surf[3]:
                $className = ucfirst($surf[3]);
                $class = 'Controller'.$className;  
                $instance_3 = new $class();
                $instance_3->{$className}();
                break;
                
            case $surf[4]:
                $className = ucfirst($surf[4]);
                $class = 'Controller'.$className;  
                $instance_4 = new $class();
                $instance_4->{$className}();
                break;
                
            case $surf[5]:
                $className = ucfirst($surf[5]);
                $class = 'Controller'.$className;  
                $instance_5 = new $class();
                $instance_5->{$className}();
                break;
           
            case $surf[6]:
                $className = ucfirst($surf[6]);
                $class = 'Controller'.$className;  
                $instance_6 = new $class();
                $instance_6->{$className}();
                break;
                
            case $surf[7]:
                $className = ucfirst($surf[7]);
                $class = 'Controller'.$className;  
                $instance_7 = new $class();
                $instance_7->{$className}();
                break;
                
            case $surf[8]:
                $className = ucfirst($surf[8]);
                $class = 'Controller'.$className;  
                $instance_8 = new $class();
                $instance_8->{$className}();
                break;
                
            case $surf[9]:
                $className = ucfirst($surf[9]);
                $class = 'Controller'.$className;  
                $instance_9 = new $class();
                $instance_9->{$className}();
                break;
                
            case $surf[10]:
                $className = ucfirst($surf[10]);
                $class = 'Controller'.$className;  
                $instance_10 = new $class();
                $instance_10->{$className}();
                break;
                
            case $surf[11]:
                $className = ucfirst($surf[11]);
                $class = 'Controller'.$className;  
                $instance_11 = new $class();
                $instance_11->{$className}();
                break;
                
            case $surf[12]:
                $className = ucfirst($surf[12]);
                $class = 'Controller'.$className;  
                $instance_12 = new $class();
                $instance_12->{$className}();
                break;
                
            case $surf[13]:
                $className = ucfirst($surf[13]);
                $class = 'Controller'.$className;  
                $instance_13 = new $class();
                $instance_13->{$className}();
                break;
                
        // Ces numéros dépassent le nombre de fichiers dans le dossier Controllers (on pourrait aisément en mettre 100,200,300.. supplémentaires pour une grosse appli qui a besoin de créer des pages tout le temps ??) :
                
            case $surf[14]:
                $className = ucfirst($surf[14]);
                $class = 'Controller'.$className;  
                $instance_14 = new $class();
                $instance_14->{$className}();
                break;            

            case $surf[15]:
                $className = ucfirst($surf[15]);
                $class = 'Controller'.$className;  
                $instance_15 = new $class();
                $instance_15->{$className}();
                break;

            case $surf[16]:
                $className = ucfirst($surf[16]);
                $class = 'Controller'.$className;  
                $instance_16 = new $class();
                $instance_16->{$className}();
                break;

            case $surf[17]:
                $className = ucfirst($surf[17]);
                $class = 'Controller'.$className;  
                $instance_17 = new $class();
                $instance_17->{$className}();
                break;
          
            default:
                throw new Exception('');
                break;
        }   
    }
    
    else {
        //Appel de la vue racine du site (Accueil)
        require_once('controllers/controllerHome.php');
        
        // Appel par défaut de la fonction Home() de la classe ControllerHome qui génère une liste de chapitres -> en appelant la fonction selectChapters du RepositoryChapter -> Repository qui "extends" la classe Database
        
        $controllerHome = new ControllerHome();
        $controllerHome->Home();
    }    
}

// En cas d'erreurs..
// Une exception est une erreur que l'on peut attraper grâce aux mots-clé try et catch //Une exception se lance grâce au mot-clé throw.

catch(Exception $e)
{
    $errorMsg = $e->getMessage();
    
    //on utilise la fonction require_once pour éviter de recharger plusieurs fois le même fichier
    require_once('views/viewError.php');
}

    
