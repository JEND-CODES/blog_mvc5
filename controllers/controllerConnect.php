<?php
session_start();

if(empty($_SESSION['connect']))
    header('Location:'.URL.'login');

// Appel au RepositoryConnect pour afficher le nom de l'utilisateur en cours
$repositoryConnect = new RepositoryConnect($bdd);

$connect = $repositoryConnect->selectUser($_SESSION['connect']); 

$repositoryChapter = new RepositoryChapter($bdd);

$repositoryComment = new RepositoryComment($bdd);

if(!empty($_POST['delete']))
{
    extract($_POST);    
    
    $repositoryChapter->deleteChapter($edit);

    $supprime = 'Chapitre supprimé';     
}

// Pour récupération des messages envoyés depuis le formulaire en page d'accueil 
$repositoryMessage = new RepositoryMessage($bdd);

$messages = $repositoryMessage->selectMessages();

//Méthode pour supprimer un message reçu dans la partie admin // il faut que l'on retrouve dans le formulaire les infos name=trash + name=modif
if(!empty($_POST['trash']))
{
    extract($_POST);    
    
    $repositoryMessage->deleteMessage($modif);

    //Méthode "header("Refresh:0");" pour actualiser la page en cours lorsqu'un message est supprimé // https://stackoverflow.com/questions/12383371/refresh-a-page-using-php
    
    header("Refresh:0");
}


$chapters = $repositoryChapter->selectChapters();

// Décompte du nombre de commentaires signalés
$alarmComments = $repositoryComment->countAlarmComments();

// Décompte total du nombre de commentaires
$alarmComments3 = $repositoryComment->countAlarmComments2();


require_once('views/viewConnect.php');