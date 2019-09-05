<?php 
$nav_title = "Édition du Slideshow"; 
?>

<?php require_once('views/header.php'); ?>

</header>

<section class="container">

    <br>

    <a href="connect" class="btn"><i class="fas fa-arrow-left"></i></a>

    <br><br>

    <div class="centered" id="stayhere2">

        <h4>Edition du slideshow</h4>

    </div>

    <div class="container">

        <div class="row">

            <div class="col s12 l12">

                <div class="card">

                    <div class="card-content">

                        <form action="#stayhere2" method="post">

                            <?php 
                
                            if(isset($success)): ?>

                            <p><?= $success ?></p>

                            <?php endif; ?>

                            <?php 
                
                            if(!empty($errors)): ?>

                            <?php foreach($errors as $error): ?>

                            <p><?= $error ?></p>

                            <?php endforeach; ?>

                            <?php endif; ?>

                            <input type="text" name="title" id="title" value="<?php if(isset($title)) echo $title; ?>" placeholder="Message" />

                            <br>

                            <input type="text" name="content" id="content2" value="<?php if(isset($content)) echo $content; ?>" placeholder="URL de l'image" />

                            <br>
                            <br>

                            <button type="submit" class="btn right">Ajouter&nbsp;<i class="fas fa-image"></i></button>

                            <br>
                            <br>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="centered">

        <h4>A la Une</h4>

    </div>


    <?php
               
    foreach($backgrounds as $background): ?>

    <!-- To fix Cards reveal Size -->

    <div id="admin-size-3">

        <!-- Cards reveal Materialize -->

        <div class="row">

            <div class="col s12">

                <div class="card">

                    <div class="card-content">

                        <span class="card-title grey-text text-darken-4">

                            <p>Message&#8239;:</p>

                            <br>

                            <p><?= $background->title() ?>
                            </p>

                            <br>

                            <img src="<?= $background->content() ?>" alt="<?= $background->title() ?>" title="Billet simple pour l'Alaska" width="100%">

                            <hr size="1px" color="#dcdcdc">

                            <p>Image ajoutée le <?= $background->backgroundDate() ?></p>

                            <form action="slider" method="post">

                                <input type="hidden" name="retirer" value="<?= $background->id() ?>" />

                                <input type="submit" name="trash2" class="btn right cyan darken-2" value="Supprimer" onclick="return(confirm('Validez-vous ce choix ?'));" />

                            </form>

                            <br>

                        </span>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>

</section>


<?php require_once('views/footer.php'); ?>
