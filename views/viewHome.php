<?php require_once('views/header.php'); ?>

</header>

<!--Images et textes du slideshow éditables en Back Office-->

<div class="slider">
    <ul class="slides">
        <?php foreach($backgrounds as $background): ?>

        <li>
            <img src="<?= $background->content() ?>" alt="Billet simple pour l'Alaska" title="Billet simple pour l'Alaska">

            <div class="caption center-align">

                <h3 class="slide_title"><?= $background->title() ?></h3>

            </div>
        </li>

        <?php endforeach; ?>

    </ul>
</div>


<div id="chapitres"></div>

<br><br><br><br>

<div class="home-sub">
    <h5>Dernières publications</h5>
</div>

<div class="container">
    <div class="row">

        <?php
        foreach($chapters as $chapter): ?>

        <div class="col s12 l12">
            <div class="card">
                <div class="card-content">

                    <a href="chapitre&amp;id=<?= $chapter->id() ?>">
                        <p class="post-title">Chapitre <?= $chapter->chapi() ?> : <?= $chapter->title() ?></p>
                    </a>
                    
                    <!-- Problème injections erreurs HTML -> utiliser un encodage ? -->
                    <?php
                /*
                    <h5 class="post-content"><?= htmlentities(substr($chapter->content(), 0, 100)) ?>...</h5>
                */
                    ?>
                    
               
                    <?php

                    // Search -> php delete all between strings

                    // Version 1 -> Test -> Deleting text between two strings in php using preg_replace (/starting point[\s\S]+?ending point/) :     
                /*   
                    echo '<hr>';

                    echo preg_replace('/Test[\s\S]+?chapitre/', '', htmlentities(substr($chapter->content(), 0, 300)));

                    echo '<hr>';
                */            
                    ?>
                 
            <h5 class="element">           
            <?php

            // Cf. Solution test méthode str_replace : https://stackoverflow.com/questions/45182891/how-to-replace-htmlentities-using-html-tags-using-php-str-replace   

            // Utilisation fonctionnelle du remplacement des balises html et des caractères spéciaux

            // Version 2 : Association des méthodes preg_replace, str_replace, substr, et htmlentities

            /*    
                $test = preg_replace('/img[\s\S]+?auto/', '', substr($chapter->content(), 0, 3000));

                echo htmlentities(str_replace(array($br, $div,$div2,$em,$em2,$p,$p2,$img,$img2),array(' '),$test));
            */                


            /*                
                $test = preg_replace('/img[\s\S]+?auto/', '', substr($chapter->content(), 0, 3000));
            */


            // Version 3 : Ajout d'éléments à effacer.. et utilisation de la méthode preg_quote() :

            /*
                // Pour repérage balise de fin d'un tag html d'image (à améliorer !) :
                
                $imageTagAuto = 'auto"';  (suppose que l'on indique un format height="auto" dans TinyMCE ?)
                
                $decode = preg_replace('/'.preg_quote('<img').'[\s\S]+?'.preg_quote(''.$imageTagAuto.'').'/', ' ', substr($chapter->content(), 0, 3000));

                echo (htmlentities(str_replace(array($sym0,$sym1,$sym2,$sym3,$sym4,$sym5,$sym6,$sym7,$sym8,$acc1,$acc2,$acc3,$br, $div,$div2,$em,$em2,$p,$p2,$endTag,$nbs,$stg,$stg2,$span, $span2),array('ë','&','ï','ä','ö','£','ù','µ','§','é','ê','à',' '),$decode)));
            */  

            // Version 4 : 
    
            require_once('content/tags.php');

            $decode = substr($chapter->content(), 0, 3000);

            echo (htmlentities(str_replace(array($sym0,$sym1,$sym2,$sym3,$sym4,$sym5,$sym6,$sym7,$sym8,$acc1,$acc2,$acc3,$br, $div,$div2,$em,$em2,$p,$p2,$endTag,$nbs,$stg,$stg2,$span, $span2),array('ë','&','ï','ä','ö','£','ù','µ','§','é','ê','à',' '),$decode)));

            // Voir le fichier script.js pour d'autres remplacements (méthode jQuery) de chaînes de caractères.. 

            ?>
            ...</h5>

                    <a href="chapitre&amp;id=<?= $chapter->id() ?>" class="btn right"><i class="fas fa-eye"></i></a>

                    <br>
                    <br>

                </div>
            </div>
        </div>

        <?php endforeach; ?>

    </div>
</div>

<section id="contact-me" class="section scrollspy">

    <br id="stayhere">

    <div class="container">

        <div class="row">

            <div class="col s12 l12">

                <div class="card" id="contact-me2">

                    <div class="card-content">

                        <h5 class="adjust-p">Contacter l'auteur</h5>

                        <form action="#stayhere" method="post">

                            <?php 
                
                        if(isset($more)): 
                        //isset — Détermine si une variable est déclarée et est différente de NULL
                        ?>

                            <p><?= $more ?></p>

                            <?php endif; ?>

                            <?php 
                
                        if(!empty($errors)): ?>

                            <?php foreach($errors as $error): ?>
                            <p><?= $error ?></p>
                            <?php endforeach; ?>

                            <?php endif; ?>

                            <div class="input-field col s6">
                                <!-- Changer le nom d'une variable dans les Models doit entraîner changement dans le controller et ici dans le formulaire -->
                                <input type="email" name="email" id="email" value="<?php if(isset($email)) echo $email; ?>" placeholder="Email" />
                            </div>

                            <div class="input-field col s6">
                                <input type="text" name="infoname" id="infoname" value="<?php if(isset($infoname)) echo $infoname; ?>" placeholder="Nom" />
                            </div>

                            <br>

                            <textarea name="content" id="content"><?php if(isset($content)) echo $content; ?></textarea>
                            <br />
                            <button type="submit" class="btn right">Envoyer&nbsp;<i class="fab fa-telegram-plane"></i></button>

                            <br>
                            <br>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<?php require_once('views/footer.php'); ?>
