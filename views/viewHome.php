<?php require_once('views/header.php'); ?>

</header>

<!--Images et textes du slideshow éditables en Back Office-->

<div class="slider">
    <ul class="slides">
        <?php foreach($backgrounds as $background): ?>

        <li>
            <img src="<?= $background->content() ?>" alt="Billet simple pour l'Alaska" title="Billet simple pour l'Alaska">

            <div class="caption center-align">

                <h3><?= $background->title() ?></h3>

            </div>
        </li>

        <?php endforeach; ?>

    </ul>
</div>

<div id="chapitres"></div>

<br><br><br><br>

<div class="home-sub">
    <h4>Dernières publications</h4>
</div>

<div class="container">
    <div class="row">

        <?php
        foreach($chapters1 as $chapter): ?>

        <div class="col s12 l12">
            <div class="card">
                <div class="card-content">

                    <a href="chapitre&amp;id=<?= $chapter->id() ?>">
                        <h4>Chapitre <?= $chapter->chapi() ?> : <?= $chapter->title() ?></h4>
                    </a>

                    <h5><?= $chapter->content() ?>...</h5>

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

                        <h4>Contacter l'auteur</h4>

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
