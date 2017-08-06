<?php
function encodeJson($data){
    return json_encode($data);
}
class Connection{ //Define class for database connection (PDO)
    private $dbhost = 'localhost';
    private $dbuser = 'root';
    private $dbpass = '';
    private $dbname = 'farmprice';

    function connect(){
        try{
            $connection_string = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $pdo = new PDO ($connection_string, $this->dbuser, $this->dbpass);
            return $pdo;
            //echo "connected";
        }catch(PDOException $exception){
            $error = "Connection failed:". $exception->getMessage();
            echo encodeJson($error);
        }
    }
}

$class = new Connection();
$class->connect();
