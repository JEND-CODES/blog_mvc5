<?php
class Message extends Common
{
    private $_id;
    private $_email;
    private $_infoname;
    private $_content;
    private $_messageDate;
    
    
    public function getId()
    {
        return $this->_id;    
    }
    public function getEmail()
    {
        return $this->_email;    
    }
    public function getInfoname()
    {
        return $this->_infoname;    
    }
    public function getContent()
    {
        return $this->_content;    
    }
    public function getMessageDate()
    {
        return $this->_messageDate;
    }
    
    
    public function setId($id)
    {
        $id = (int) $id;
        
        if($id > 0)
            $this->_id = $id;
    }
    public function setEmail($email)
    {
        if(is_string($email))
            
            $this->_email = $email;
    }
    public function setInfoname($infoname)
    {
        if(is_string($infoname))
            
            $this->_infoname = $infoname;
    }
    public function setContent($content)
    {
        if(is_string($content))
            $this->_content = $content;
    }
    public function setMessageDate($messageDate)
    {
        $this->_messageDate = $messageDate;
    }
  
}


