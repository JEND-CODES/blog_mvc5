<?php

// POO class -> Accès au Back Office

class ControllerConnect
{
    private $admin_connect;
    private $admin_chapters;
    private $admin_comments;
    private $admin_messages;
    
    public function __construct()
    {
        // Appel au RepositoryConnect pour afficher le nom de l'utilisateur en cours
        $this->admin_connect = new RepositoryConnect();
        
        // Appel au RepositoryChapter pour afficher les publications
        $this->admin_chapters = new RepositoryChapter();

        // Appel au RepositoryComment pour afficher le décompte de commentaires et de leurs signalements
        $this->admin_comments = new RepositoryComment();
        
        // Appel au RepositoryMessage pour l'affichage des messages envoyés depuis le formulaire en page d'accueil 
        $this->admin_messages = new RepositoryMessage();
    }
    
    public function Connect()
    {
  
        session_start();
        
        if(empty($_SESSION['connect']))
            header('Location:'.URL.'login');

        $connect = $this->admin_connect->selectUser($_SESSION['connect']); 

        if(!empty($_POST['delete']))
        {
            extract($_POST);    

            $this->admin_chapters->deleteChapter($edit);

            $supprime = 'Chapitre supprimé';     
        }

        $messages = $this->admin_messages->selectMessages();

        //Méthode pour supprimer un message reçu dans la partie admin // il faut que l'on retrouve dans le formulaire les infos name=trash + name=modif
        if(!empty($_POST['trash']))
        {
            extract($_POST);    

            $this->admin_messages->deleteMessage($modif);

            //Méthode "header("Refresh:0");" pour actualiser la page en cours lorsqu'un message est supprimé // https://stackoverflow.com/questions/12383371/refresh-a-page-using-php

            header("Refresh:0");
        }


        $chapters = $this->admin_chapters->selectChapters();

        // Décompte du nombre de commentaires signalés
        $alarmComments = $this->admin_comments->countAlarmComments();

        // Décompte total du nombre de commentaires
        $totalComments = $this->admin_comments->countNumberComments();


        require_once('views/viewConnect.php');

    }
}
