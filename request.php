<?php

class Request
{
    
    public function JsonData()
    {
        
        header('Content-Type: application/json');

        $req = new PDO('mysql:host=localhost;dbname=bootmvc30;charset=utf8', 'root', '');
       
        $data = [];

        // sprintf — Retourne une chaîne formatée
        $query = sprintf('SELECT chapi, alarm FROM chapters WHERE alarm > 0 ORDER BY chapi');

        $result = $req->query($query);

        foreach ($result as $row) {
            $data[] = $row;
        }

        print json_encode($data);
    }
}

$request = new Request();
$request->JsonData();


