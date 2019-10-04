<!DOCTYPE html>

<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Permet de définir l'affichage du titre du site par défaut et de spécifier ensuite des titres différents dans les différentes pages-->
    <title><?php echo isset($nav_title)?$nav_title:"Billet simple pour l'Alaska"; ?></title>

    <meta name="description" content="Billet simple pour l'Alaska de Jean Forteroche">

    <meta content='width=device-width, initial-scale=1.0' name='viewport' />

    <link rel="icon" type="image/png" href="<?= URL.'content/images/feather.jpg' ?>" />

    <link rel="stylesheet" href="<?= URL.'content/style.css' ?>" />

    <!-- Police du site -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:400,700&display=swap" rel="stylesheet">
    
    <!-- Police du Slideshow -->
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    
    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/5k258xz8b8894li1zboryqoh74ms5pwkns3ket7ysg708h1g/tinymce/5/tinymce.min.js"></script>

    <!--Chargement Langage Fr TinyMCE-->
    <script src="content/langs/fr_FR.js"></script>

    <!-- TinyMCE init function -->
    <script>
        tinymce.init({
            /*
            // Cf. https://stackoverflow.com/questions/31965807/tinymce-customizing-new-lines
            
            // Tests du 27-30 septembre : changements du format des balises par défaut de l'éditeur TinyMCE pour décodage htmlentities ajouté dans viewHome : 
            
            setup: function(editor) {
            editor.on('PostProcess', function(ed) {
                ed.content = ed.content.replace(/(<span>)/gi,'<span><p>').replace(/(<\/span>)/gi,'<\/span><\/p><p>').replace(/<img.*?src="(.*?)"[^\>]+>/gi,'<\/p><img.*?src="(.*?)"[^\>]+><p>');
            });
        },
            */
            /*
            setup: function(editor) {
            editor.on('PostProcess', function(ed) {
            ed.content = ed.content.replace(/(<p>)/gi,'<p><span>').replace(/(<\/p>)/gi,'<\/span><\/p>');
            });
        },
            */
            
            // 30 septembre -> Cette fonction ajoute une balise <br /> supplémentaire lors d'un saut de ligne et intercale un espace vide (&nbsp;) entre les deux balises <br /> -> pour éviter que les mots collent les uns aux autres lors de l'affichage sur viewHome qui utilise un strip_tags :
            /*
            setup: function(editor) {
            editor.on('PostProcess', function(ed) {
            ed.content = ed.content.replace(/(<br \/>)/gi,'<br \/>&nbsp;<br \/>');
            });
        },
        */
            // 1er octobre -> Cette fonction remplace un nombre trop important de balises <br /> consécutives -> 8 x <br /> = 2 <br /> !
            // -> Cela empêche d'avoir un aperçu du chapitre en page d'accueil avec des <br /> infinis qui ne sont pas annulés par le substring !
            setup: function(editor) {
            editor.on('PostProcess', function(ed) {
            ed.content = ed.content.replace(/(<br \/><br \/><br \/><br \/><br \/><br \/><br \/><br \/>)/gi,'<br \/><br \/>');
            });
        },
            selector: 'textarea.tinymce',
            language: 'fr_FR',
            height: 700,
            plugins: [
                'image link code media emoticons',
            ],
            branding: false,
            
            // Tests du 27-30 sept : Réglage en forced_p_newlines:'true' pour améliorer (?) le décodage htmlentities ajouté dans viewHome (retrait du force_root_block = '')
            
            // Test sans insertions de balises <p> (il n'y aura donc que des <span> et des <br />): 
            force_br_newlines: true,
            force_p_newlines: false,
            
            forced_root_block: '',
            
            toolbar: 'undo redo | bold italic underline | link | image | code | media | forecolor backcolor | emoticons',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ]
        });
     
    </script>
 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">

    <!-- Compiled and minified CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Fontawesome and Material Icons -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>

    <header>
        <div class="feather-logo">
            <i class="fas fa-feather-alt"></i>
        </div>

        <div class="navbar-fixed ">
            <nav class=" blue lighten-2">
                <div class="nav-wrapper ">

                    <a href="<?= URL ?>" class="brand-logo"> 
                            <h1><strong>Billet simple pour l'Alaska</strong></h1>
                        
                    </a>

                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

                    <ul class="right hide-on-med-and-down" id="bar-text">

                        <li><a href="<?= URL ?>" class="bounce-text">Accueil</a></li>

                        <li><a href="<?= URL.'biographie' ?>" class="bounce-text">Biographie</a></li>

                        <li class="scroll"><a href="<?= URL.'index.php#chapitres' ?>" class="bounce-text">Chapitres</a></li>
                        
                        <li><a href="<?= URL.'sommaire' ?>" class="bounce-text">Sommaire</a></li>

                        <li><a href="<?= URL.'login' ?>" class="effet-plus"> Back Office</a></li>

                        <li><a href="<?= URL.'index.php#contact-me' ?>" class="btn waves-effect waves-light blue lighten-3" id="nav-button">Contact</a></li>

                    </ul>
                </div>
            </nav>
        </div>

        <ul class="sidenav" id="mobile-demo">

            <li><a href="<?= URL ?>">Accueil</a></li>

            <li><a href="<?= URL.'biographie' ?>">Biographie</a></li>

            <li><a href="<?= URL.'index.php#chapitres' ?>">Chapitres</a></li>

            <li><a href="<?= URL.'sommaire' ?>">Sommaire</a></li>

            <li><a href="<?= URL.'login' ?>">Back Office</a></li>

            <li><a href="<?= URL.'index.php#contact-me' ?>">Contact</a></li>

        </ul>
