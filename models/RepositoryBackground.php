<?php

class RepositoryBackground extends Database
{
    
    public function selectBackgrounds()
    {  
        $backgrounds = array();
        
        $req = $this->connectDB()->query('SELECT id, title, content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS backgroundDate FROM backgrounds ORDER BY id DESC');
        $req->execute();
        while($data = $req->fetch())
        {
            $backgrounds[] = new Background($data);
        }
        return $backgrounds;
        $req->closeCursor();
    }
   
    public function selectBackground($id)
    {
        $req = $this->connectDB()->prepare('SELECT * FROM backgrounds WHERE id = ?');
        $req->execute(array($id));
        
        if($req->rowCount() == 1)
        {
            $data = $req->fetch();
            return new Background($data);   
        }
        
        $req->closeCursor();
    }
    
    public function insertBackground($ajouter)
    {
        $req = $this->connectDB()->prepare('INSERT INTO backgrounds (title, content, date) VALUES(?, ?, NOW())');
        $req->execute(array($ajouter->title(), $ajouter->content()));
        $req->closeCursor();    
    }
   
    public function deleteBackground($retirer)
    {
        $req = $this->connectDB()->prepare('DELETE FROM backgrounds WHERE id = ?');
        $req->execute(array($retirer));
        $req->closeCursor();    
    }
    
    
}

