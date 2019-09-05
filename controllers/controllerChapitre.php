<?php

// Méthode d'affichage aléatoire des images Parallaxes en haut
$dir = 'content/random/';
  
  $imgs_arr = array();
  
  if (file_exists($dir) && is_dir($dir) ) {
    
      $dir_arr = scandir($dir);
      $arr_files = array_diff($dir_arr, array('.','..') );
      
      foreach ($arr_files as $file) {
        $file_path = $dir."/".$file;
        $ext = pathinfo($file_path, PATHINFO_EXTENSION);
        if ($ext=="jpg" || $ext=="png" || $ext=="JPG" || $ext=="PNG") {
          array_push($imgs_arr, $file);
        }
        
      }
      $count_img_index = count($imgs_arr) - 1;
      $random_img = $imgs_arr[rand( 0, $count_img_index )];
  }

// Méthode d'affichage aléatoire des images Parallaxes en bas
$dir2 = 'content/random/';
  
  $imgs_arr2 = array();
  
  if (file_exists($dir2) && is_dir($dir2) ) {
    
      $dir_arr2 = scandir($dir2);
      $arr_files2 = array_diff($dir_arr2, array('.','..') );
      
      foreach ($arr_files2 as $file2) {
        $file_path2 = $dir2."/".$file2;
        $ext2 = pathinfo($file_path2, PATHINFO_EXTENSION);
        if ($ext2=="jpg" || $ext2=="png" || $ext2=="JPG" || $ext2=="PNG") {
          array_push($imgs_arr2, $file2);
        }
        
      }
      $count_img_index2 = count($imgs_arr2) - 1;
      $random_img2 = $imgs_arr2[rand( 0, $count_img_index2 )];
  }

// Contrôle du paramètre Get correspondant à l'Id 
// Le controller fait un test, un contrôle : il vérifie qu'on a reçu ou non en paramètre un id dans l'url ( $_GET['id']

if(empty($_GET['id']) OR !is_numeric($_GET['id']))
    throw new Exception('Page introuvable'); 
else
{
    extract($_GET);
    //méthode pour récupérer l'ID du chapitre
    
    $id = htmlentities($id);
    
    // Appel du modèle Chapter
    $repositoryChapter = new RepositoryChapter($bdd);
    
    // Appel du modèle Comment
    $repositoryComment = new RepositoryComment($bdd);
    
    // Contrôle des champs obligatoires pour commenter un chapitre
    if(!empty($_POST['add']))
    {
        extract($_POST);
        $errors = array();
        //Le tableau $errors doit rester vide pour valider le formulaire 
        
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
            $repositoryComment->insertComment($insertcom);

            $realized = 'Commentaire publié';
            
            unset($email);
            unset($pseudo);
            unset($comment);
        }
    }

    
    if(!empty($_POST['alert']))
    {
        extract($_POST);

        $repositoryComment->alarmComment($act);

        $ok = 'Commentaire signalé';     
    }
    
    // Sélection de l'ID d'un chapitre avec format de date modifié
    $chapter = $repositoryChapter->selectChapter1($id);   

    // Select article précédent
    $prevChapter = $repositoryChapter->prevChapter($id);   

    // Select article suivant
    $nextChapter = $repositoryChapter->nextChapter($id);
    
    // Sélection des commentaires associés à chaque chapitre
    $comments = $repositoryComment->selectComments($id);
    
    // Sélection des 5 derniers commentaires
    $comments2 = $repositoryComment->selectComments2($id);

    // Nombre de commentaires pour chaque chapitre
    $countComments = $repositoryComment->countComments($id);

    if($comments == NULL)
    {
        $toggle = NULL;
        
        $nocomment = '<br/><p>Encore aucun commentaire pour ce chapitre</p><br/>';
        
        $nocomment2 = '<br/><p>Encore aucun commentaire pour ce chapitre</p><br/>';
        
    }else
    {
        $toggle = '<br/><button class="waves-effect waves-light btn grey lighten-1 right" id="ghost"><p id="ghost4"><i class="fas fa-long-arrow-alt-down"></i></p><p id="ghost3"><i class="fas fa-long-arrow-alt-up"></i></p></button><br/><br/>';
        
        $nocomment = 'Commentaires du chapitre';
        
        $nocomment2 = '<h4>Derniers commentaires</h4><br">';
    }
    
    // Chapter Alarm + 1
    if(!empty($_POST['loving']))
    {
        extract($_POST);

        $repositoryChapter->alarmChapter($alarm);

        $likethis = 'Appréciation envoyée';
    }

    require_once('views/viewChapitre.php');
}



