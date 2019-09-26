<?php

class RepositoryComment extends Database
{
    private $_dateComment_1;
    private $_dateComment_2;
    
    public function __construct(){
        
        $this->_dateComment_1 = 'DATE_FORMAT(date, "%d/%m/%Y à %Hh %imin %ss") AS commentDate';
        
        $this->_dateComment_2 = 'DATE_FORMAT(date, "%d/%m/%Y à %Hh%i") AS commentDate';
       
    }

    //cf. Tuto OpenC https://openclassrooms.com/fr/courses/4670706-adoptez-une-architecture-mvc-en-php/4735671-passage-du-modele-en-objet
    
    // Sélection de tous les commentaires (affichage page d'un chapitre)
    public function selectComments($chapterId)
    {
        $comments = [];
        
        $req = $this->connectDB()->prepare(
            'SELECT *, 
            '.$this->_dateComment_2.' 
            FROM comments 
            WHERE chapter_id = ? 
            ORDER BY id 
            ASC');
        
        $req->execute(array($chapterId)); 
        while($data = $req->fetch())
        {
            $comments[] = new Comment($data);
        }
        return $comments;
        $req->closeCursor();
    }
    
    // Sélection des 5 derniers commentaires (affichage page d'un chapitre) avec alternance de l'ordre
    public function selectCommentsDesc($chapterId)
    {
        $comments2 = [];
        
        $req = $this->connectDB()->prepare(
            'SELECT *, 
            '.$this->_dateComment_1.' 
            FROM comments 
            WHERE chapter_id = ? 
            ORDER BY id 
            DESC 
            LIMIT 0,5'
        );
        
        $req->execute(array($chapterId)); 
        while($data = $req->fetch())
        {
            $comments2[] = new Comment($data);
        }
        return $comments2;
        $req->closeCursor();
    }
  
    // Ajout d'un commentaire
    public function insertComment($insertcom)
    {
        $req = $this->connectDB()->prepare('INSERT INTO comments (email, chapter_id, pseudo, comment, date) VALUES(?, ?, ?, ?, NOW())');
        
        $req->execute(array($insertcom->email(), $insertcom->chapterId(), $insertcom->pseudo(), $insertcom->comment()));
        
        $req->closeCursor();
    }
    
     // Suppression d'un commentaire
    public function deleteComment($act)
    { 
        $req = $this->connectDB()->prepare('DELETE FROM comments WHERE id = ?');
        
        $req->execute(array($act));
        $req->closeCursor();
    }
   
    // Signalement d'un commentaire
    public function alarmComment($act)
    {
        $req = $this->connectDB()->prepare('UPDATE comments SET alarm = alarm+1 WHERE id = ?');
        
        $req->execute(array($act));
        $req->closeCursor();
    }
   
    // Sélection de tous les commentaires par ordre décroissant (variable "$alarmComments" utilisée dans controllerCommentaire)
    public function selectAlarmComments()
    {
        $alarmComments = [];
        
        $req = $this->connectDB()->prepare(
            'SELECT *, 
            '.$this->_dateComment_2.' 
            FROM comments 
            WHERE alarm > 0 
            ORDER BY alarm 
            DESC');
        $req->execute(); 
        while($data = $req->fetch())
        {
            $alarmComments[] = new Comment($data);
        }
        return $alarmComments;
        $req->closeCursor();        
    }
    
    // Sélection de tous les commentaires par ordre décroissant (variable "$alarmComments2" utilisée dans controllerCommentaire)
    public function selectAlarmCommentsDesc()
    {
        $alarmComments2 = [];
        
        $req = $this->connectDB()->prepare(
            'SELECT id, pseudo, comment, alarm, email, 
            '.$this->_dateComment_1.' 
            FROM comments 
            ORDER BY id 
            DESC'
        );
        $req->execute(); 
        while($data = $req->fetch())
        {
            $alarmComments2[] = new Comment($data);
        }
        return $alarmComments2;
        $req->closeCursor();        
    }
    
    // Décompte des commentaires pour chaque chapitre
    public function countComments($chapterId)
    {
        $req = $this->connectDB()->prepare('SELECT COUNT(id) FROM comments WHERE chapter_id = ?');
        $req->execute(array($chapterId));
        return $req->fetchColumn();
        $req->closeCursor();        
    }
    
    // Décompte du nombre de commentaires signalés
    public function countAlarmComments()
    {
        $req = $this->connectDB()->prepare('SELECT COUNT(id) FROM comments WHERE alarm > 0');
        $req->execute();
        return $req->fetchColumn();
        $req->closeCursor();
    }
    
    // Décompte du nombre total de commentaires (sans tri de signalements)
    public function countAlarmComments2()
    {
        $req = $this->connectDB()->prepare('SELECT COUNT(id) FROM comments');
        $req->execute();
        return $req->fetchColumn();
        $req->closeCursor();
    }
  
    
}
