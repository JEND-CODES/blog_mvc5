<?php foreach ($posts as $value): ?>

<p style="color:red">New link -> viewChapitre </p>

<a href="chapter&amp;id=<?= $value['id'] ?>">
                        
<h2><?= $value['title'] ?></h2>
    
</a>

<p><?= $value['chapterDate'] ?></p>

<img src="<?= $value['zerolink'] ?>" alt="Billet simple pour l'Alaska" title="Billet simple pour l'Alaska" width="10%" height="10%">

<div ><?= $value['content'] ?>...</div>

<div class="btn">Lire le chapitre</div>

<?php endforeach; ?>
