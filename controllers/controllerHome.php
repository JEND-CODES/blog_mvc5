<?php

//Contrôleur : cette partie gère la logique du code qui prend des décisions. C'est en quelque sorte l'intermédiaire entre le modèle et la vue : le contrôleur va demander au modèle les données, les analyser, prendre des décisions et renvoyer le texte à afficher à la vue. Le contrôleur contient exclusivement du PHP. C'est notamment lui qui détermine si le visiteur a le droit de voir la page ou non (gestion des droits d'accès).

//Mise à jour du contrôleur - Maintenant que nous avons créé des classes, il nous faut créer des objets à partir d'elles. cf.tuto openC - https://openclassrooms.com/fr/courses/4670706-adoptez-une-architecture-mvc-en-php/4735671-passage-du-modele-en-objet

// A placer dans le dossier controller/controllerAccueil.php

//Instanciation de l'objet création de l'objet $repositoryArticle et récupération des articles avec création de l'objet $articles
//Créer et manipuler un objet Créer un objet Nous allons voir comment créer un objet, c'est-à-dire que nous allons utiliser notre classe afin qu'elle nous fournisse un objet.

//L'auto-chargement de classes - Pour une question d'organisation, il vaut mieux créer un fichier par classe.

//le constructeur de la classe appelle chaque setter pour assigner les valeurs qu'on lui a données aux attributs correspondants

$repositoryChapter = new RepositoryChapter($bdd);

$chapters1 = $repositoryChapter->selectChapters1();

$repositoryMessage = new RepositoryMessage($bdd);

$messages = $repositoryMessage->selectMessages();

// Images du slideshow
$repositoryBackground = new RepositoryBackground($bdd);

$backgrounds = $repositoryBackground->selectBackgrounds();

if(!empty($_POST))
{
    extract($_POST);
    $errors = array();
    
    // Empêcher les attaques XSS. Utiliser la fonction plus approprié htmlentities()
    // En savoir plus sur les failles XSS -> https://openclassrooms.com/fr/courses/2091901-protegez-vous-efficacement-contre-les-failles-web/2680167-la-faille-xss
    //XSS (plus officiellement appelée Cross-Site Scripting) est une faille permettant l'injection de code HTML ou JavaScript dans des variables mal protégées
    
    $email = htmlentities($email);
    
    $infoname = htmlentities($infoname);
    
    $content = htmlentities($content);

    if(empty($email))
        array_push($errors, 'Entrez votre Email');
   
    //condition pour avoir un format mail valide, et avoir obligatoirement le symbole @ dans l'email cf.https://stackoverflow.com/questions/5855811/how-to-validate-an-email-in-php //https://www.php.net/manual/en/function.preg-match.php // https://www.guru99.com/php-regular-expressions.html
    if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email)) {
       array_push($errors, 'Format de mail invalide');
    }
    
    if(empty($infoname))
        array_push($errors, 'Nom manquant');
    
    if(!empty($infoname) && strlen($infoname)>100)
        array_push($errors, 'Nom trop long');

    if(empty($content))
        array_push($errors, 'Message manquant');
    
    //limite du nombre de caractères pour l'envoi du message en page accueil
    if(!empty($content) && strlen($content)>280)
        array_push($errors, 'Message trop long');

    if(count($errors) == 0)
    { 
        $plus = new Message(array('email'=>$email, 'infoname'=>$infoname, 'content'=>$content));
        
        $repositoryMessage->insertMessage($plus);

        $more = 'Message envoyé';

        unset($email);
        unset($infoname);
        unset($content);
    }
}


require_once('views/viewHome.php');


