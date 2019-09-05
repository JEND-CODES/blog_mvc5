<?php
class RepositoryMessage
{
    private $_bdd;
    
    public function __construct($bdd)
    {
        $this->setBdd($bdd);
    }
    
    public function selectMessages()
    {  
        $messages = array();
        
        $req = $this->_bdd->query('SELECT id, email, infoname, content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS messageDate FROM messages ORDER BY id DESC');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $messages[] = new Message($data);
        }
        return $messages;
        $req->closeCursor();
    }
  
    public function selectMessage($id)
    {
        $req = $this->_bdd->prepare('SELECT id, email, infoname, content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh %imin %ss\') AS messageDate FROM messages WHERE id = ?');
        $req->execute(array($id));
        
        if($req->rowCount() == 1)
        {
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return new Message($data);   
        }
        
        $req->closeCursor();
    }
    
    public function insertMessage($plus)
    {
        $req = $this->_bdd->prepare('INSERT INTO messages (email, infoname, content, date) VALUES(?, ?, ?, NOW())');
        $req->execute(array($plus->email(), $plus->infoname(), $plus->content()));
        $req->closeCursor();    
    }
   
    public function deleteMessage($modif)
    {
        $req = $this->_bdd->prepare('DELETE FROM messages WHERE id = ?');
        $req->execute(array($modif));
        $req->closeCursor();    
    }
    
//Explication de closeCursor();
//https://www.php.net/manual/fr/pdostatement.closecursor.php

//PDOStatement::closeCursor() libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées, mais laisse la requête dans un état lui permettant d'être de nouveau exécutée.

//closeCursor() ne sert pas à fermer la connexion avec la base de données.

//Elle sert à finir proprement une série de fetch().

//En théorie, quand on exécute une requête (via query() ou execute()), puis qu'on récupère les données trouvées dans la base avec une série de fetch(), il convient de faire un closeCursor() avant de faire une autre exécution de requête (via query() ou execute())

    public function setBdd(PDO $bdd)
    {
        $this->_bdd = $bdd;
    }
}

?>