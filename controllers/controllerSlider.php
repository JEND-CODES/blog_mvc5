<?php

// POO class -> Edition du Slideshow en Back Office

class ControllerSlider
{
    private $slides;
    
    public function __construct(){
        
        $this->slides = new RepositoryBackground();
    }
    
    public function __invoke()
    {
   
        session_start();
        
        if(empty($_SESSION['connect']))
            header('Location:'.URL.'login');

        $backgrounds = $this->slides->selectBackgrounds();

        if(!empty($_POST))
        {
            extract($_POST);
            $errors = array();

            if(empty($title))
                array_push($errors, "Il manque votre message");
            
            if(!empty($title) && strlen($title)>300)
                array_push($errors, "Message trop long");

            if(empty($content))
                array_push($errors, "Entrez l'URL de l'image");

            if(count($errors) == 0)
            { 
                $ajouter = new Background(array('title'=>$title, 'content'=>$content));

                $this->slides->insertBackground($ajouter);

                header("Refresh:0");

            }
        }

        if(!empty($_POST['trash2']))
        {
            extract($_POST);    

            $this->slides->deleteBackground($retirer);

            header("Refresh:0");

        }

        require_once('views/viewSlider.php');
        
                
    }
}
