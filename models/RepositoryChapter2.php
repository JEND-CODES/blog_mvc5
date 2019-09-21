<?php

require_once("models/Database2.php");

class RepositoryChapter2 extends Database2
{

	public function selectChapters()
    {
        $db = $this->bdd_connected();

        $req = $db->query('SELECT id, title, SUBSTRING(content, 1, 380) AS content, chapi, alarm, zerolink, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS chapterDate, DATE_FORMAT(refreshdate, \'%d/%m/%Y à %Hh %imin %ss\') AS refreshDate FROM chapters ORDER BY id DESC');

        return $req;
    }
    
     public function selectChapter($id)
    {
        $db = $this->bdd_connected();

        $req = $db->prepare('SELECT id, title, content, chapi, alarm, DATE_FORMAT(date, \'%d/%m/%Y\') AS chapterDate FROM chapters WHERE id = ?');
        
        $req->execute(array($id));
        $post = $req->fetch();
        $req->closeCursor();

        return $chapter;
    }

}
