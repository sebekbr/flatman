<?php
class Property{

    // database connection and table name
    private $conn;
    private $table_name = "property";

    // object properties
    public $id;
    public $name;
    public $address;
    public $postalcode;
    public $city;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read all properties
    function read(){

        // select all query
        $query = "SELECT
                    `id`, `name`, `address`, `postalcode`, `city`
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
    // get single property data
    function read_single(){

        // select all query
        $query = "SELECT
                    `id`, `name`, `address`, `postalcode`, `city`
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
    // create property
    function create(){

        if($this->isAlreadyExist()){
            return false;
        }

        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ."
                        (`id`, `name`, `address`, `postalcode`, `city`)
                  VALUES
                        ('".$this->name."', '".$this->address."', '".$this->postalcode."', '".$this->city."')";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }
    // update property
    function update(){

        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='".$this->name."', address='".$this->address."', postalcode='".$this->postalcode."', city='".$this->city."'
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
    // delete property
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
                address='".$this->address."'";
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
