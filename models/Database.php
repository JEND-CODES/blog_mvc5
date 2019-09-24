<?php 

class Database
{
	
    protected function connectDB()
    {
    
    	$db = new PDO('mysql:host=localhost;dbname=bootmvc30;charset=utf8', 'root', '');
        
    	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    	return $db;
    }
}
