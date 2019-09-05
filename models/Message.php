<?php
class Message
{
    private $_id;
    private $_email;
    private $_infoname;
    private $_content;
    private $_messageDate;
    
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
  
    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
           
        {
            $method = 'set'.ucfirst($key);
            
            if(method_exists($this, $method))
                $this->$method($value);
        }
    }
  
    public function id()
    {
        return $this->_id;    
    }
    public function email()
    {
        return $this->_email;    
    }
    public function infoname()
    {
        return $this->_infoname;    
    }
    public function content()
    {
        return $this->_content;    
    }
    public function messageDate()
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

?>
