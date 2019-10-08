<?php

// POO class

class ControllerHome
{
    private $posts;
    private $images;
    private $writings;
    
    // Déclaration d'attributs/propriétés privées -> La visibilité d'une propriété, d'une méthode ou (à partir de PHP 7.1.0) une constante peut être définie en préfixant sa déclaration avec un mot-clé : public, protected, ou private. Les éléments déclarés comme publics sont accessibles partout. L'accès aux éléments protégés est limité à la classe elle-même, ainsi qu'aux classes qui en héritent et parente. L'accès aux éléments privés est uniquement réservé à la classe qui les a définis (Cf. https://www.php.net/manual/fr/language.oop5.visibility.php)

    public function __construct()
    {
        $this->posts = new RepositoryChapter;
        // Permet de remplacer l'instanciation classique dans ce format : $repositoryChapter = new RepositoryChapter();
        
        $this->images = new RepositoryBackground;
        
        $this->writings = new RepositoryMessage;
        
        // PHP permet aux développeurs de déclarer des constructeurs pour les classes. Les classes qui possèdent une méthode constructeur appellent cette méthode à chaque création d'une nouvelle instance de l'objet, ce qui est intéressant pour toutes les initialisations dont l'objet a besoin avant d'être utilisé (Cf. https://www.php.net/manual/fr/language.oop5.decon.php)
        
    }
    
    public function __invoke()
    {

        // Permet d'appeler la function du RepositoryChapter en suivant la méthode "__construct"
        
        $chapters = $this->posts->selectChaptersDesc();
        
        // Idem pour les images du slideshow
        $backgrounds = $this->images->selectBackgrounds();
        
        // Gestion des erreurs et de la validation du formulaire de messagerie en page d'accueil
        if(!empty($_POST))
        {
            extract($_POST);
            $errors = array();

            // Empêcher les attaques XSS. Utiliser la fonction plus appropriée : htmlentities()
            // En savoir plus sur les failles XSS -> https://openclassrooms.com/fr/courses/2091901-protegez-vous-efficacement-contre-les-failles-web/2680167-la-faille-xss
            // XSS (plus officiellement appelée Cross-Site Scripting) est une faille permettant l'injection de code HTML ou JavaScript dans des variables mal protégées

            $email = htmlentities($email);

            $infoname = htmlentities($infoname);

            $content = htmlentities($content);

            if(empty($email))
                array_push($errors, 'Entrez votre Email');

            // Condition pour avoir un format mail valide, et avoir obligatoirement le symbole @ dans l'email cf.https://stackoverflow.com/questions/5855811/how-to-validate-an-email-in-php //https://www.php.net/manual/en/function.preg-match.php // https://www.guru99.com/php-regular-expressions.html
            
            if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,5}$/", $email)) {
               array_push($errors, 'Format de mail invalide');
            }

            if(empty($infoname))
                array_push($errors, 'Nom manquant');

            if(!empty($infoname) && strlen($infoname)>100)
                array_push($errors, 'Nom trop long');

            if(empty($content))
                array_push($errors, 'Message manquant');

            // Limite du nombre de caractères pour l'envoi du message
            
            if(!empty($content) && strlen($content)>280)
                array_push($errors, 'Message trop long');

            if(count($errors) == 0)
            { 
                $plus = new Message(array('email'=>$email, 'infoname'=>$infoname, 'content'=>$content));

                //Appel de l'attribut privé "writings" de la classe ControllerHome, puis de la fonction du RepositoryMessage
                
                $this->writings->insertMessage($plus);

                $more = 'Message envoyé';

                unset($email);
                unset($infoname);
                unset($content);
            }
        }

        require_once('views/viewHome.php');

    }
  
}
