<?php

// include database and object files
include_once '../config/db.php';
include_once '../objects/property.php';
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare property object
$property = new Property($db);

// set property property values
$property->name = $_POST['name'];
$property->address = $_POST['address'];
$property->postalcode = $_POST['postalcode'];
$property->city = $_POST['city'];
// create the property
if($property->create()){
    $property_arr=array(
        "status" => true,
        "message" => "Pomyślnie dodano",
        "id" => $property->id,
        "name" => $property->name,
        "address" => $property->address,
        "postalcode" => $property->postalcode,
        "city" => $property->city,
    );
}
else{
    $property_arr=array(
        "status" => false,
        "message" => "address already exists!"
    );
}
print_r(json_encode($property_arr));
?>
