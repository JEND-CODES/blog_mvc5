<?php
class RepositoryBackground
{
    private $_bdd;
    
    public function __construct($bdd)
    {
        $this->setBdd($bdd);
    }
    
    public function selectBackgrounds()
    {  
        $backgrounds = array();
        
        $req = $this->_bdd->query('SELECT id, title, content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS backgroundDate FROM backgrounds ORDER BY id DESC');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $backgrounds[] = new Background($data);
        }
        return $backgrounds;
        $req->closeCursor();
    }
   
    public function selectBackground($id)
    {
        $req = $this->_bdd->prepare('SELECT id, title, content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS backgroundDate FROM backgrounds WHERE id = ?');
        $req->execute(array($id));
        
        if($req->rowCount() == 1)
        {
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return new Background($data);   
        }
        
        $req->closeCursor();
    }
    
    public function insertBackground($ajouter)
    {
        $req = $this->_bdd->prepare('INSERT INTO backgrounds (title, content, date) VALUES(?, ?, NOW())');
        $req->execute(array($ajouter->title(), $ajouter->content()));
        $req->closeCursor();    
    }
   
    public function deleteBackground($retirer)
    {
        $req = $this->_bdd->prepare('DELETE FROM backgrounds WHERE id = ?');
        $req->execute(array($retirer));
        $req->closeCursor();    
    }
    
    public function setBdd(PDO $bdd)
    {
        $this->_bdd = $bdd;
    }
}

?>