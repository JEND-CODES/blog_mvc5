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

/*

// Même requête au format "new PDO" :

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

*/

/*

// Même requête au format "new mysqli" :

//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'bootmvc30');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
  die("Erreur : " . $mysqli->error);
}

//query to get data from the table
$query = sprintf('SELECT chapi, alarm FROM chapters WHERE alarm > 0 ORDER BY chapi');

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);

*/
