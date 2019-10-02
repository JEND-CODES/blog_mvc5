<?php 
$nav_title = "Sommaire"; 
?>

<?php require_once('views/header.php'); ?>

</header>

<br />
<br />

<section class="container" id="sommaire-size">
    <div class="row">

        <?php
        // Sommaire du livre
        foreach($chapters2 as $chapter2): ?>

        <div class="col s6">
            
            <p>Chapitre <?= $chapter2->getChapi() ?></p>

            <a href="chapitre&amp;id=<?= $chapter2->getId() ?>">
                <p class="sommaire-title"><?= $chapter2->getTitle() ?></p>
            </a>

            <?php
            //Si le champs Homepage Specific Post Image est vide, ne pas afficher
            if(!empty($chapter2->getZerolink())):      
            ?>

            <a href="chapitre&amp;id=<?= $chapter2->getId() ?>">
                <img src="<?= $chapter2->getZerolink() ?>" alt="Billet simple pour l'Alaska" title="Billet simple pour l'Alaska" class="responsive-img" />
            </a>

            <?php endif; ?>

            <hr class="simple-line">
        </div>

        <?php endforeach; ?>

    </div>

</section>

<?php require_once('views/footer.php'); ?>
