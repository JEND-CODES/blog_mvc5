<?php

define('ROOT', dirname(__FILE__));

$self = htmlentities($_SERVER['PHP_SELF']);

define('URL', str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$self"));

spl_autoload_register(function($class){
    require('models/' .$class. '.php');
});

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

catch(Exception $e)
{
    $errorMsg = $e->getMessage();
    
    //on utilise la fonction require_once pour éviter de recharger plusieurs fois le même fichier
    require_once('views/viewError.php');
}

    
