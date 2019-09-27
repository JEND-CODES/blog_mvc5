<?php

// POO class -> Edition d'un nouveau chapitre en Back Office

class ControllerEdit
{
    private $new_chapter;
    
    public function __construct()
    {
        
        $this->new_chapter = new RepositoryChapter();
    }
    
    public function Edit()
    {

        session_start();
        
        if(empty($_SESSION['connect']))
            header('Location:'.URL.'login');

        if(!empty($_POST))
        {
            extract($_POST);
            $errors = array();

            $title = htmlentities($title);

            $chapi = htmlentities($chapi);

            $zerolink = htmlentities($zerolink);

            if(empty($title))
                array_push($errors, 'Titre manquant');

            if(empty($chapi))
                array_push($errors, 'Précisez le numéro du chapitre');

            if(empty($content))
                array_push($errors, 'Contenu manquant');

            if(count($errors) == 0)
            { 
                $edit = new Chapter(array('title'=>$title, 'content'=>$content,'chapi'=>$chapi,'zerolink'=>$zerolink));

                $this->new_chapter->insertChapter($edit);

                $increase = 'Chapitre publié';

                unset($title);
                unset($chapi);
                unset($content);
                unset($zerolink);
            }
        }

        require_once('views/viewEdit.php');

    }
}
