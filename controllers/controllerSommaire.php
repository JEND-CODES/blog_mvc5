<?php

$repositoryChapter = new RepositoryChapter($bdd);

$chapters2 = $repositoryChapter->selectChapters2();

require_once('views/viewSommaire.php');