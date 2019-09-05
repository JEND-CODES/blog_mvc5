<?php 
$nav_title = "Sommaire"; 
?>

<?php require_once('views/header.php'); ?>

</header>

<br>
<br>

<section class="container" id="sommaire-size">
    <div class="row">

        <?php
        // Sommaire du livre
        foreach($chapters2 as $chapter2): ?>

        <div class="col s6">
            
            <p>Chapitre <?= $chapter2->chapi() ?></p>

            <a href="chapitre&amp;id=<?= $chapter2->id() ?>">
                <p class="sommaire-title"><?= $chapter2->title() ?></p>
            </a>

            <?php
            //Si le champs Homepage Specific Post Image est vide, ne pas afficher
            if(!empty($chapter2->zerolink())):      
            ?>

            <a href="chapitre&amp;id=<?= $chapter2->id() ?>">
                <img src="<?= $chapter2->zerolink() ?>" alt="Billet simple pour l'Alaska" title="Billet simple pour l'Alaska" width="100%">
            </a>

            <?php endif; ?>

            <hr size="1px" color="#dcdcdc">
        </div>

        <?php endforeach; ?>

    </div>

</section>

<?php require_once('views/footer.php'); ?>
