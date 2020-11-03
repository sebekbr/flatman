<?php
class Landlord{

    // database connection and table name
    private $conn;
    private $table_name = "landlords";

    // object properties
    public $id;
    public $name;
    public $surname;
    public $phone;
    public $email;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read all properties
    function read(){

        // select all query
        $query = "SELECT
                    `id`, `name`, `surname`, `phone`, `email`
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
    // get single landlord data
    function read_single(){

        // select all query
        $query = "SELECT
                    `id`, `name`, `surname`, `phone`, `email`
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
    // create landlord
    function create(){

        if($this->isAlreadyExist()){
            return false;
        }

        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ."
                        (`id`, `name`, `surname`, `phone`, `email`)
                  VALUES
                        ('".$this->name."', '".$this->surname."', '".$this->phone."', '".$this->email."')";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }
        return false;
    }
    // update landlord
    function update(){

        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='".$this->name."', surname='".$this->surname."', phone='".$this->phone."', email='".$this->email."'
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
    // delete landlord
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
