<?php
class Background
{
    private $_id;
    private $_title;
    private $_content;
    private $_backgroundDate;
    
   
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
  
    public function getId()
    {
        return $this->_id;    
    }
    public function getTitle()
    {
        return $this->_title;    
    }
    public function getContent()
    {
        return $this->_content;    
    }
    public function getBackgroundDate()
    {
        return $this->_backgroundDate;
    }   
  
    public function setId($id)
    {
        $id = (int) $id;
        
        if($id > 0)
            $this->_id = $id;
    }
    public function setTitle($title)
    {
        if(is_string($title))
            
            $this->_title = $title;
    }
    public function setContent($content)
    {
        if(is_string($content))
            $this->_content = $content;
    }
    public function setBackgroundDate($backgroundDate)
    {
        $this->_backgroundDate = $backgroundDate;
    }
}

