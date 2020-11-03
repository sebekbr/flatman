<?php
class HouseAssociation{

    // database connection and table name
    private $conn;
    private $table_name = "houseassociations";

    // object properties
    public $id;
    public $name;
    public $address;
    public $postalcode;
    public $city;
    public $phone;
    public $email;
    public $comments;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read all properties
    function read(){

        // select all query
        $query = "SELECT
                    `id`, `name`, `address`, `postalcode`, `city`, `phone`, `email`, `comments`
                FROM
                    " . $this->table_name . "
                ORDER BY
                    id DESC";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    // get single houseassociation data
    function read_single(){

        // select all query
        $query = "SELECT
                    `id`, `name`, `address`, `postalcode`, `city`, `phone`, `email`, `comments`
                FROM
                    " . $this->table_name . "
                WHERE
                    id= '".$this->id."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        return $stmt;
    }
    // create houseassociation
    function create(){

        if($this->isAlreadyExist()){
            return false;
        }

        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ."
                        (`id`, `name`, `address`, `postalcode`, `city`, `phone`, `email`, `comments`)
                  VALUES
                        ('".$this->name."', '".$this->address."', '".$this->postalcode."',
                        '".$this->city."', '".$this->phone."', '".$this->email."', '".$this->comments."')";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }
    // update houseassociation
    function update(){

        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='".$this->name."', address='".$this->address."', postalcode='".$this->postalcode."',
                    city='".$this->city."', phone='".$this->phone."', email='".$this->email."', comments='".$this->comments."'
                WHERE
                    id='".$this->id."'";

        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    // delete houseassociation
    function delete(){

        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    id= '".$this->id."'";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . "
            WHERE
                name='".$this->name."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}
