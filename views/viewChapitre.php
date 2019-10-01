<?php 
$nav_title = $chapter->getTitle(); 
//permet de définir le titre du chapitre comme titre de l'onglet du navigateur
?>

<?php require_once('views/header.php'); ?>

<?php 
// Appel pour changements du format des dates ($month_1, $month_2)
require_once('content/dates.php'); ?>

</header>

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
?>

<div class="parallax-container">
    <div class="parallax">

        <img src="<?php echo $dir."/".$random_img ?>" alt="illustration" title="illustration">

        <div id="chapter-title">

            <p id="chapter-title2">Chapitre <?= $chapter->getChapi() ?> : <?= $chapter->getTitle() ?></p>

        </div>

    </div>
</div>

<p class="signature">publié le 

    <?php
    // Transformer date_format : Cf. https://www.php.net/manual/fr/datetime.format.php
    // Solution avec strtotime() -> Cf. https://tecadmin.net/convert-date-format-in-php/

    $sql_Date_1 = $chapter->getChapterDate();

    $new_Date_Format_1 = date("d .m Y", strtotime($sql_Date_1));

    echo str_replace($month_1,$month_2,$new_Date_Format_1);

    ?>
    
</p>

<br>

<div class="button-parts">
    
    <?php 
    // Si la longueur du chapitre dépasse 3500 caractères.. On montre les boutons des parties 1 et 2 du chapitre :
    
    // Interactive bookmarks chapter parts 1 and 2 
    if(strlen($chapter->getContent()) > 3500): ?>

        <button class="btn waves-effect waves-light" id="bookmark1"><i class="far fa-bookmark"></i> 1 </button>

        <button class="btn waves-effect waves-light" id="bookmark2"><i class="far fa-bookmark"></i> 2 </button>

    <?php endif; ?>

    <?php 
    // Si la longueur du chapitre dépasse 7000 caractères.. On montre le bouton de la partie 3 du chapitre :    

    // Interactive bookmark chapter part 3
    if(strlen($chapter->getContent()) > 7000): ?>

        <button class="btn waves-effect waves-light" id="bookmark3"><i class="far fa-bookmark"></i> 3 </button>

    <?php endif; ?>
    
</div>
            <?php

        /*
        
            <h5 class="post-content" id="chapter-part1">
            <?= 
            // Starting point : 0
            // Showing 3500
            
            // La méthode strpos permet de ne pas couper le dernier mot avant transition vers l'onglet partie 2 du chapitre :
            
            // Cette méthode fonctionne bien pour régler le découpage du texte à la fin de la première partie, mais ne marche pas pour les autres onglets -> (solutions ? Cf. https://stackoverflow.com/questions/1652406/php-pagination-script / ou créer une fonction wordwrap()?)
    
            substr($chapter->getContent(), 0, strpos($chapter->getContent(), ' ', 3500)); ?>
            </h5>
            
        */

            ?>

            <h5 id="chapter-part1">
            <?= 
            // Starting point : 0
            // Showing 3500
            substr($chapter->getContent(), 0, 3500); ?>
            <?php 
            // Affichage du trait d'union uniquement si la taille du texte est supérieure à 3500 caractères
            if(strlen($chapter->getContent()) > 3500){ 
            ?>
                
            -

            <?php } ?>
            </h5>


    <?php 
    // Affichage onglet partie 2 du chapitre
    if(strlen($chapter->getContent()) >= 3500): ?>

            <h5 id="chapter-part2"> -
            <?= 
            // Starting point : 3500
            // Showing more 3500
            substr($chapter->getContent(), 3500, 3500); ?>
        
            <?php 
            // Affichage du trait d'union uniquement si la taille du texte est supérieure à 7000 caractères
            if(strlen($chapter->getContent()) > 7000){ 
            ?>
                
            -

            <?php } ?>
            </h5>

            <?php endif; ?>


    <?php 
    // Affichage onglet partie 3 du chapitre
    if(strlen($chapter->getContent()) >= 7000): ?>


            <h5 id="chapter-part3"> -
                <?= 
                // Starting point : 7000
                // Showing all after this point..
                substr($chapter->getContent(), 7000); ?>
            </h5>


    <?php endif; ?>

<br>
<br>

<?php 

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

?>

<div class="parallax-container">
    <div class="parallax">

        <img src="<?php echo $dir2."/".$random_img2 ?>" alt="illustration" title="illustration">

    </div>
</div>

<br>

<div class="row" id="chapter-link">

    <?php 
    if($prevChapter): ?>

    <a href="chapitre&amp;id=<?= $prevChapter->getId() ?>" class="btn"><i class="fas fa-chevron-left"></i></a>

    <?php endif; ?>

    <a href="<?= URL.'sommaire' ?>" class="btn"><i class="fas fa-book-open"></i></a>

    <?php
    if($nextChapter): ?>

    <a href="chapitre&amp;id=<?= $nextChapter->getId() ?>" class="btn"><i class="fas fa-chevron-right"></i></a>

    <?php endif; ?>

    <br>
    <br>

    <!-- Appréciation du chapitre-->
    <p>Avez-vous apprécié ce chapitre ?</p>

    <?php 
                
    if(isset($likethis)): ?>

    <br>
    <p><?= $likethis ?></p>

    <?php endif; ?>

    <form action="#chap-like" method="post">

        <input type="hidden" name="alarm" value="<?= $chapter->getId() ?>" />

        <input type="submit" name="loving" class="btn blue lighten-2" value="Oui !" onclick="return(confirm('Validez-vous ce choix ?'));" />

    </form>

</div>

<br>
<br>

<div class="row" id="form-comment">

    <form id="form" action="#victory" method="post">

        <div class="centered">
            <h5 class="flower">Commenter ce chapitre</h5>
        </div>

        <div class="input-field col s6">
            <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)) echo $pseudo; ?>" placeholder="Votre nom" />
        </div>

        <div class="input-field col s6">
            <input type="email" name="email" id="email" value="<?php if(isset($email)) echo $email; ?>" placeholder="Votre adresse mail" />
        </div>

        <br />
        <textarea name="comment" id="comment"><?php if(isset($comment)) echo $comment; ?></textarea>

        <br />
        <input type="submit" name="add" class="btn right" value="Envoyer" onclick="return(confirm('Validez-vous ce choix ?'));" />
    </form>
    <br />

</div>


<br id="signal">

<section class="chapter-part2" id="victory">

    <div class="container" id="ghost0">

        <?= 
    //Affiche le bouton toggle commentaires    
    $toggle 
    ?>

    </div>

    <div class="container" id="ghost1">

        <?php 
                
        if(!empty($errors)): ?>

        <br>

        <?php foreach($errors as $error): ?>

        <div class="centered">
            <p><?= $error ?></p>
        </div>

        <?php endforeach; ?>

        <br>

        <?php endif; ?>


        <?php 
                
    if(isset($realized)): ?>

        <p><?= $realized ?></p>

        <?php endif; ?>


        <?php
    
    if(isset($ok)): ?>

        <p><?= $ok ?></p>

        <?php endif; ?>


        <?= 
        // Message lorsqu'il n'y a pas encore de commentaires
        $nocomment2 
        ?>


        <?php
        // Affichage des 5 derniers commentaires
        foreach($comments2 as $comAsc): ?>

        <hr size="1px" color="#dcdcdc">

        <p>Par <?= ucfirst($comAsc->getPseudo()) ?> le 
 
            <?php

            $sql_Date_2 = $comAsc->getCommentDate();

            $new_Date_Format_2 = date("d .m Y à H:i", strtotime($sql_Date_2));

            echo str_replace($month_1,$month_2,$new_Date_Format_2);

            ?>
        
        </p>
        <p>'' <?= $comAsc->getComment() ?> ''</p>

        <form action="#signal" method="post">

            <input type="hidden" name="act" value="<?= $comAsc->getId() ?>" />
            <input type="submit" name="alert" class="btn" value="Signaler" onclick="return(confirm('Validez-vous ce choix ?'));" />

        </form>

        <br>

        <?php endforeach; ?>

    </div>


    <div class="container" id="ghost2">

        <h5><?= $nocomment ?> (total&#8239;:&#8239;<?= $countComments ?>)</h5>
        <br>

        <?php
        // Affichage de tous les commentaires du chapitre
        foreach($comments as $comDesc): ?>

        <hr size="1px" color="#dcdcdc">

        <p>Par <?= ucfirst($comDesc->getPseudo()) ?> le 
        
            <?php
 
            $sql_Date_3 = $comDesc->getCommentDate();

            $new_Date_Format_3 = date("d .m Y à H:i", strtotime($sql_Date_3));

            echo str_replace($month_1,$month_2,$new_Date_Format_3);

            ?>
        
        </p>
        <p>'' <?= $comDesc->getComment() ?> ''</p>

        <form action="#signal" method="post">

            <input type="hidden" name="act" value="<?= $comDesc->getId() ?>" />

            <input type="submit" name="alert" class="btn" value="Signaler" onclick="return(confirm('Validez-vous ce choix ?'));" />

        </form>

        <br>

        <?php endforeach; ?>

    </div>

</section>



<?php require_once('views/footer.php'); ?>
