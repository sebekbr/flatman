<?php
// include database and object files
include_once '../config/db.php';
include_once '../objects/property.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare property object
$property = new Property($db);
// set ID property of property to be edited
$property->id = isset($_GET['id']) ? $_GET['id'] : die();
// read the details of property to be edited
$stmt = $property->read_single();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $property_arr=array(
        "id" => $row['id'],
        "name" => $row['name'],
        "address" => $row['address'],
        "postalcode" => $row['postalcode'],
        "city" => $row['city'],
    );
}
// make it json format
print_r(json_encode($property_arr));
?>
