<?php

class ControllerStatistiques
{
    
    public function __invoke()
    {
  
        session_start();

        if(empty($_SESSION['connect']))

        header('Location:'.URL.'login');

        require_once('views/viewStatistiques.php');
        
    }
}
