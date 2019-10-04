<?php 
$nav_title = "Statistiques"; 
?>

<?php require_once('views/header.php'); ?>

</header>

<br />

<div class="container">

    <a href="connect" class="btn"><i class="fas fa-arrow-left"></i></a>

</div>

<div class="centered">

    <h5>Likes par chapitres</h5>

</div>

<div id="chart-container">

    <canvas id="mycanvas"></canvas>

</div>

<?php require_once('views/footer.php'); ?>
