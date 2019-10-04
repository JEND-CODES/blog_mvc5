<?php

class RepositoryMessage extends Database
{
    
    public function selectMessages()
    {  
        $messages = array();
        
        $req = $this->connectDB()->query('SELECT id, email, infoname, content, DATE_FORMAT(date, \'%d/%m/%Y à %Hh%i\') AS messageDate FROM messages ORDER BY id DESC');
        $req->execute();
        while($data = $req->fetch())
        {
            $messages[] = new Message($data);
        }
        return $messages;
        $req->closeCursor();
    }
  
    public function selectMessage($id)
    {
        $req = $this->connectDB()->prepare('SELECT * FROM messages WHERE id = ?');
        $req->execute(array($id));
        
        if($req->rowCount() == 1)
        {
            $data = $req->fetch();
            return new Message($data);   
        }
        
        $req->closeCursor();
    }
    
    public function insertMessage($plus)
    {
        $req = $this->connectDB()->prepare('INSERT INTO messages (email, infoname, content, date) VALUES(?, ?, ?, NOW())');
        $req->execute(array($plus->getEmail(), $plus->getInfoname(), $plus->getContent()));
        $req->closeCursor();    
    }
   
    public function deleteMessage($modif)
    {
        $req = $this->connectDB()->prepare('DELETE FROM messages WHERE id = ?');
        $req->execute(array($modif));
        $req->closeCursor();    
    }
    
//Explication de closeCursor();
//https://www.php.net/manual/fr/pdostatement.closecursor.php

//PDOStatement::closeCursor() libère la connexion au serveur, permettant ainsi à d'autres requêtes SQL d'être exécutées, mais laisse la requête dans un état lui permettant d'être de nouveau exécutée.

//closeCursor() ne sert pas à fermer la connexion avec la base de données.

//Elle sert à finir proprement une série de fetch().

//En théorie, quand on exécute une requête (via query() ou execute()), puis qu'on récupère les données trouvées dans la base avec une série de fetch(), il convient de faire un closeCursor() avant de faire une autre exécution de requête (via query() ou execute())

    
}

