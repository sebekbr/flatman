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
$property->id = $_POST['id'];

// remove the property
if($property->delete()){
    $property_arr=array(
        "status" => true,
        "message" => "Successfully Removed!"
    );
}
else{
    $property_arr=array(
        "status" => false,
        "message" => "Nieruchomość nie może zostać usunięta. Sprawdź powiązania."
    );
}
print_r(json_encode($property_arr));
?>
