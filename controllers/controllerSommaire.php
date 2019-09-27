<?php

// POO class -> Affichage du sommaire du livre

class ControllerSommaire
{
    private $book;
    
    public function __construct(){
        
        $this->book = new RepositoryChapter();
    }
    
    public function Sommaire()
    {
        
        $chapters2 = $this->book->selectChaptersAsc();

        require_once('views/viewSommaire.php');
        
    }
}

