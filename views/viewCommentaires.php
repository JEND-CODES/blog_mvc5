<?php 
$nav_title = "Gestion des commentaires"; 
?>

<?php require_once('views/header.php'); ?>

<?php 
// Appel pour changements du format des dates ($month_1, $month_2)
require_once('content/dates.php'); ?>

</header>

<section id="commentaires-signales" class="container">

    <br />

    <a href="connect" class="btn"><i class="fas fa-arrow-left"></i></a>

    <br /><br />

    <!--Materialize Tabs-->

    <div class='col s12 m6 l4 offset-l2'>

        <ul class="tabs">
            <li class="tab col s3"><a href="#test1" class='active blue-text'><i class="fas fa-bell"></i></a></li>
            <li class="tab col s3"><a class="blue-text" href="#test2"><i class="fas fa-comment"></i></a></li>
        </ul>
    </div>

    <div class="container pt-10">

        <div class="row card">

            <div id="test1" class="col s12">
                
                <?php 
            
                if(isset($drop)): ?>

                <p>&nbsp;<?= $drop ?></p>

                <?php endif; ?>

                <h5 class='header'>&nbsp;Signalements</h5>
                
                <ul class="collection">

                    <?php foreach($alarmComments as $alarmComment): ?>

                    <li class="collection-item">

                        <p>Le commentaire de <?= ucfirst($alarmComment->getPseudo()) ?> &rArr; <a href="https://login.yahoo.com/" target="_blank" class="linkmail"><?= $alarmComment->getEmail() ?></a> posté le 
       
                            <?php

                            $sql_Date_1 = $alarmComment->getCommentDate();

                            $new_Date_Format_1 = date("d .m Y à H:i", strtotime($sql_Date_1));

                            echo str_replace($month_1,$month_2,$new_Date_Format_1);

                            ?>

                            a été signalé <?= $alarmComment->getAlarm() ?> fois</p>

                        <p>''&nbsp;<?= $alarmComment->getComment() ?>&nbsp;''</p>

                        <form action="commentaires" method="post">

                            <input type="hidden" name="act" value="<?= $alarmComment->getId() ?>" />

                            <input type="submit" name="delete" class="btn right" value="Supprimer" onclick="return(confirm('Validez-vous ce choix ?'));" />

                        </form>

                        <br />
                        <br />

                    </li>

                    <?php endforeach; ?>

                </ul>

            </div>

            <div id="test2" class="col s12">

                <h5 class='header'>&nbsp;Commentaires</h5>

                <ul class="collection">

                    <?php foreach($alarmComments2 as $alarmComment2): ?>

                    <li class="collection-item">

                        <p>Posté par <?= ucfirst($alarmComment2->getPseudo()) ?> &rArr; <a href="https://login.yahoo.com/" target="_blank" class="linkmail"><?= $alarmComment2->getEmail() ?></a> le 

                            <?php

                            $sql_Date_2 = $alarmComment2->getCommentDate();

                            $new_Date_Format_2 = date("d .m Y à H:i", strtotime($sql_Date_2));

                            echo str_replace($month_1,$month_2,$new_Date_Format_2);

                            ?>

                            &#8239;: </p>

                        <p>''&nbsp;<?= $alarmComment2->getComment() ?>&nbsp;''</p>

                        <form action="commentaires" method="post">

                            <input type="hidden" name="act" value="<?= $alarmComment2->getId() ?>" />

                            <input type="submit" name="delete" class="btn right" value="Supprimer" onclick="return(confirm('Validez-vous ce choix ?'));" />

                        </form>

                        <br />
                        <br />

                    </li>

                    <?php endforeach; ?>

                </ul>

            </div>
        </div>
    </div>

</section>

<?php require_once('views/footer.php'); ?>
