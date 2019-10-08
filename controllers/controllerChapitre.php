<?php

// POO class -> Affichage de chaque chapitre et des commentaires associés

class ControllerChapitre
{
    private $show_post;
    private $commentaries;
    
    public function __construct()
    {
        
        $this->show_post = new RepositoryChapter();
        $this->commentaries = new RepositoryComment();
    }
 
    public function __invoke()
    {
    
        // Contrôle du paramètre Get correspondant à l'Id 
        // Le controller fait un test, un contrôle : il vérifie qu'on a reçu ou non en paramètre un id dans l'url ( $_GET['id']

        if(empty($_GET['id']) OR !is_numeric($_GET['id']))
            throw new Exception('Page introuvable'); 
        else
        {
            extract($_GET);
            //méthode pour récupérer l'ID du chapitre

            $id = htmlentities($id);

            // Contrôle des champs obligatoires pour commenter un chapitre
            
            if(!empty($_POST['add']))
            {
                extract($_POST);
                $errors = array();
                
                // Le tableau $errors doit rester vide pour valider le formulaire 

                // Empêcher les attaques XSS. Utiliser la fonction plus approprié htmlentities()
                
                $pseudo = htmlentities($pseudo);

                $email = htmlentities($email);

                $comment = htmlentities($comment);

                if(empty($pseudo))
                    array_push($errors, 'Nom manquant');

                if(!empty($pseudo) && strlen($pseudo)<3)
                    array_push($errors, 'Votre pseudo est trop court');

                if(!empty($pseudo) && strlen($pseudo)>30)
                    array_push($errors, 'Votre pseudo est trop long');

                if(empty($email))
                array_push($errors, 'Entrez votre Email');

                if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email)) {
                   array_push($errors, 'Format d\'Email invalide');
                }

                if(empty($comment))
                    array_push($errors, 'Commentaire manquant');

                if(!empty($comment) && strlen($comment)>280)
                    array_push($errors, 'Votre commentaire est trop long');

                // Ajout d'un commentaire dans la base de données

                if(count($errors) == 0)
                { 

                    $insertcom = new Comment(array('chapterId'=>$id, 'pseudo'=>$pseudo, 'comment'=>$comment, 'email'=>$email));
                    
                    $this->commentaries->insertComment($insertcom);

                    $realized = 'Commentaire publié';

                    unset($email);
                    unset($pseudo);
                    unset($comment);
                }
            }


            if(!empty($_POST['alert']))
            {
                extract($_POST);

                $this->commentaries->alarmComment($act);

                $ok = 'Commentaire signalé';     
            }

            // Sélection de l'ID d'un chapitre avec format de date modifié
            $chapter = $this->show_post->selectChapterFront($id);
            
            // Select article précédent
            $prevChapter = $this->show_post->prevChapter($id);   

            // Select article suivant
            $nextChapter = $this->show_post->nextChapter($id);

            // Sélection des commentaires associés à chaque chapitre
            $comments = $this->commentaries->selectComments($id);

            // Sélection des 5 derniers commentaires
            $comments2 = $this->commentaries->selectCommentsDesc($id);

            // Nombre de commentaires pour chaque chapitre
            $countComments = $this->commentaries->countComments($id);

            if($comments == NULL)
            {
                $toggle = NULL;

                $nocomment = '<br/><p>Encore aucun commentaire pour ce chapitre</p><br/>';

                $nocomment2 = '<br/><p>Encore aucun commentaire pour ce chapitre</p><br/>';

            }else
            {
                $toggle = '<br/><a class="waves-effect waves-light btn grey lighten-1 right" id="ghost"><p id="ghost4"><i class="fas fa-long-arrow-alt-down"></i></p><p id="ghost3"><i class="fas fa-long-arrow-alt-up"></i></p></a><br/><br/>';

                $nocomment = '<p class="title-comments">Commentaires du chapitre</p>';

                $nocomment2 = '<br/><p class="title-comments">Derniers commentaires</p><br/>';
            }

            // Chapter Alarm + 1
            if(!empty($_POST['loving']))
            {
                extract($_POST);

                $this->show_post->alarmChapter($alarm);

                $likethis = 'Appréciation envoyée';
            }

        }

             require_once('views/viewChapitre.php');
         
    }
    
}



