<?php
require_once "test.php";
/**
 * Define DB methods to be used by your API. That is if you need a DB.
 * I guess your dumbass needs one
 */
class Models
{
    public $db = null;
    public function  __construct(){
        $dhb = new Connection();
        $this->db = $dhb->connect();
        //return $db;
    }
    public function addUser($user_name, $user_state, $user_about)
    {
        try{
        $query = "INSERT INTO users (name, state, about)VALUES(:name, :state, :about)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $user_name);
        $stmt->bindParam(':state', $user_state);
        $stmt->bindParam(':about', $user_about);
        $stmt->execute();
        }catch(PDOException $exception){
            echo $exception->getMessage();
        }

    }
    public function getUser($id) //Insert a new user
    {
        try {
            $query = "SELECT * FROM users where id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            var_dump($user); //Return the ID of the newly created user.
        }catch(PDOException $exception){
            return $exception->getMessage();
        }
    }
    public function addProduce($name, $description) //Insert a new user
    {
        try {
            $query = "INSERT INTO produce (name, description)VALUES(:name, :description)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':state', $description);
            $stmt->execute();
            return $this->db->lastInsertId(); //Return the ID of the newly created user.
        }catch(PDOException $exception){
            return $exception->getMessage();
        }
    }
    public function addPrice($user_id, $produce_id, $price) //Insert a new price
    {
        try {
            /**
             * Check if the user(farmer) exist
             */
            $query = "SELECT * FROM users where id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$user_id]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            /**
             * Check if produce exist
             */
            $query = "SELECT * FROM produce where id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$produce_id]);
            $produce = $stmt->fetch(PDO::FETCH_OBJ);

            /**
             * Check if produce already exist in the farm_prices table
             */
            $query = "SELECT * FROM farm_prices where id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$produce_id]);
            $product = $stmt->fetch(PDO::FETCH_OBJ);

            if($user == false) { //Check if user already exist
                return 'user does not exist';
            }else if($produce == false){
                return 'produce does not exist';
            }
            else if ($product){
                return 'produce already exist';
            }else{
                $query = "INSERT INTO farm_prices (user_id, produce_id, price)VALUES(:user_id, :produce_id, :price)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':produce_id', $produce_id);
                $stmt->bindParam(':price', $price);
                $stmt->execute();
                return 'price added'; //Return the ID of the newly created user.
            }
        }catch(PDOException $exception){
            return $exception->getMessage();
        }
    }
    public function updatePrice($user_id, $produce_id, $price) //update price of a produce
    {
        try {
            /**
             * Check if the user(farmer) exist
             */
            $query = "SELECT * FROM users where id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$user_id]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            /**
             * Check if produce exist
             */
            $query = "SELECT * FROM produce where id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$produce_id]);
            $produce = $stmt->fetch(PDO::FETCH_OBJ);
            if($user == false) { //Check if user already exist
                return 'user does not exist';
            }else if($produce == false){
                return 'produce does not exist';
            }
            else{
                $query = "UPDATE farm_prices SET price = :price where user_id = :user_id and produce_id = :produce_id";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':produce_id', $produce_id);
                $stmt->execute();
                return 'price updated'; //Return the ID of the newly created user.
            }
        }catch(PDOException $exception){
            return $exception->getMessage();
        }
    }


}

$class = new Models();
echo $class->updatePrice('4', '1', '19000');

