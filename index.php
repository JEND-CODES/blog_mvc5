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

// Appel de toutes les classes du fichier Models 
spl_autoload_register(function($class){
    require('models/' .$class. '.php');
});

// Contrôle de l'affichage des pages :
try
{
    //Appel des pages via les fichiers controllers
    if(isset($_GET['action']))
    {
        if(file_exists('controllers/controller' . ucfirst($_GET['action']) . '.php')) {
            require_once('controllers/controller' . ucfirst($_GET['action']) . '.php');
        } //https://www.php.net/manual/fr/function.ucfirst.php
            
        else {
            throw new Exception('');
        }       
    }
    
    else {
        //Appel de la vue racine du site (Accueil)
        require_once('controllers/controllerHome.php');
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

// Instanciation des Controllers
// Appel des classes et des fonctions des controllers
// Adoption de la méthode switch/case :
try {
        
    if (isset($_GET['action'])) {
            
        switch ($_GET['action']) {
            
            case 'biographie':
            $controllerBiographie = new ControllerBiographie();
            $controllerBiographie->Biographie();
            break;

            case 'change':
            $controllerChange = new ControllerChange();
            $controllerChange->Change();         
            break;

            case 'chapitre':
            $controllerChapitre = new ControllerChapitre();
            $controllerChapitre->Chapitre();          
            break;

            case 'commentaires':
            $controllerCommentaires = new ControllerCommentaires();
            $controllerCommentaires->Commentaires();
            break;

            case 'connect':
            $controllerConnect = new ControllerConnect();
            $controllerConnect->Connect();         
            break;

            case 'edit':
            $controllerEdit = new ControllerEdit();
            $controllerEdit->Edit();          
            break;

            case 'login':
            $controllerLogin = new ControllerLogin();
            $controllerLogin->Login();        
            break;

            case 'nosession':
            $controllerNosession = new ControllerNosession();
            $controllerNosession->Nosession();
            break;

            case 'password':
            $controllerPassword = new ControllerPassword();
            $controllerPassword->Password();         
            break;

            case 'slider':
            $controllerSlider = new ControllerSlider();
            $controllerSlider->Slider();          
            break;

            case 'sommaire':
            $controllerSommaire = new ControllerSommaire();
            $controllerSommaire->Sommaire();         
            break;

            case 'statistiques':
            $controllerStatistiques = new ControllerStatistiques();
            $controllerStatistiques->Statistiques();  
            break;

            default:
            throw new Exception('');
            break;
        }
    }

    else {
        // Appel par défaut de la fonction Home() de la classe ControllerHome qui génère une liste de chapitres -> en appelant la fonction selectChapters du RepositoryChapter -> Repository qui "extends" la classe Database 
        $controllerHome = new ControllerHome();
        $controllerHome->Home();
    }
}
catch (Exception $e) 
{
    $errorMsg = $e->getMessage();
    
    require_once('views/viewError.php');
}


    

