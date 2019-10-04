<div class="fixed-action-btn ">
    <a class="btn-floating btn-large cyan darken-2">
        <i class="fas fa-share"></i>
    </a>
    <ul>
        <li><a class="btn-floating light-blue darken-4"><i class="fab fa-facebook-f"></i></a></li>
        <li><a class="btn-floating blue"><i class="fab fa-twitter"></i></a></li>
        <li><a class="btn-floating purple darken-1"><i class="fab fa-linkedin-in"></i></a></li>
        <li><a class="btn-floating amber darken-3"><i class="far fa-envelope"></i></a></li>

    </ul>
</div>

<br /><br />

<section id="football">
    
<footer class="page-footer cyan darken-3" id="myfooter">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text" id="footer-t1">Publications de Jean Forteroche</h5>

                <div class="carousel">
                    <a class="carousel-item" href="#one!"><img class="carousel-image" src="content/images/book3.JPG" alt="Illustration" title="Illustration"></a>
                    <a class="carousel-item" href="#two!"><img class="carousel-image" src="content/images/book4.JPG" alt="Illustration" title="Illustration"></a>
                    <a class="carousel-item" href="#three!"><img class="carousel-image" src="content/images/book5.JPG" alt="Illustration" title="Illustration"></a>
                    <a class="carousel-item" href="#four!"><img class="carousel-image" src="content/images/book1.JPG" alt="Illustration" title="Illustration"></a>
                    <a class="carousel-item" href="#five!"><img class="carousel-image" src="content/images/book2.JPG" alt="Illustration" title="Illustration"></a>
                </div>

            </div>
            <div class="col l4 offset-l2 s12">

                <h5 class="white-text" id="footer-t2">Plus d'infos</h5>

                <ul class="footer-text1">
                    
                    <li><a class="grey-text text-lighten-4" href="https://github.com/JEND-CODES" target="_blank">Réalisation</a></li>
                    <li><a class="grey-text text-lighten-4" href="https://github.com/JEND-CODES" target="_blank">Jean-Eudes Nouaille-Degorce</a></li>
                    <li>&nbsp;</li>
                    <li><a class="grey-text text-lighten-3" href="https://github.com/JEND-CODES" target="_blank">GitHub</a></li>
                    <li><a class="grey-text text-lighten-3" href="https://github.com/JEND-CODES" target="_blank">Portfolio</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <h6>© Copyright jeanforteroche.fr</h6>
        </div>
    </div>
</footer>
    
</section>

<!-- Return to Top -->
<a href="javascript:" id="return-to-top"><i class="fas fa-chevron-up"></i></a>

<!-- Dernière version du CDN jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<!-- Script Animations JQuery -->
<script src="content/js/script.js"></script>

<!-- Script Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>

<?php 
// Condition d'activation du script Chart Graph JS pour éviter le message d'erreur dans la console lié à la requête de request.php
if(strpos($_SERVER['REQUEST_URI'], 'statistiques')): ?>

<!-- Properties Graph Chart.js -->
<script src="content/js/app.js"></script>

<?php endif; ?>

</body>

</html>
