<?php
class Tenant{

    // database connection and table name
    private $conn;
    private $table_name = "tenants";

    // object properties
    public $id;
    public $name;
    public $surname;
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
                    `id`, `name`, `surname`, `address`, `postalcode`, `city`, `phone`, `email`, `comments`
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
    // get single tenant data
    function read_single(){

        // select all query
        $query = "SELECT
                    `id`, `name`, `surname`, `address`, `postalcode`, `city`, `phone`, `email`, `comments`
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
    // create tenant
    function create(){

        if($this->isAlreadyExist()){
            return false;
        }

        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ."
                        (`id`, `name`, `surname`, `address`, `postalcode`, `city`, `phone`, `email`, `comments`)
                  VALUES
                        ('".$this->name."', '".$this->surname."', '".$this->address"', '".$this->postalcode."',
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
    // update tenant
    function update(){

        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='".$this->name."', surname='".$this->surname."', address='".$this->address"', postalcode='".$this->postalcode."',
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
    // delete tenant
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
                email='".$this->email."'";
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
