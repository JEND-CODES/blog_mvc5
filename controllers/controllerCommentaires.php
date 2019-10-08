<?php

// POO class -> Gestion des commentaires en Back Office

class ControllerCommentaires
{
    private $back_comment;
    
    public function __construct()
    {
        $this->back_comment = new RepositoryComment();
    }
    
    public function __invoke()
    {
      
        session_start();
        
        if(empty($_SESSION['connect']))
            header('Location:'.URL.'login');

        if(!empty($_POST['delete']))
        {
            extract($_POST);

            $this->back_comment->deleteComment($act);

            $drop = 'Commentaire supprimé';     
        }

        $alarmComments = $this->back_comment->selectAlarmComments();

        $alarmComments2 = $this->back_comment->selectAlarmCommentsDesc();

        require_once('views/viewCommentaires.php');
      
    }
}
