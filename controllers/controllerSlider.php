<?php
session_start();

if(empty($_SESSION['connect']))
    header('Location:'.URL.'login');

$repositoryBackground = new RepositoryBackground($bdd);

$backgrounds = $repositoryBackground->selectBackgrounds();

if(!empty($_POST))
{
    extract($_POST);
    $errors = array();
    
    if(empty($title))
        array_push($errors, "Il manque votre message");
 
    if(empty($content))
        array_push($errors, "Entrez l'URL de l'image");


    if(count($errors) == 0)
    { 
        $ajouter = new Background(array('title'=>$title, 'content'=>$content));
        
        $repositoryBackground->insertBackground($ajouter);
        
        header("Refresh:0");

    }
}

if(!empty($_POST['trash2']))
{
    extract($_POST);    
    
    $repositoryBackground->deleteBackground($retirer);

    header("Refresh:0");
    
}

require_once('views/viewSlider.php');