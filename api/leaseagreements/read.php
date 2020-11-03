<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/property.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare property object
$property = new Property($db);

// query property
$stmt = $property->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){

    // propertys array
    $propertys_arr=array();
    $propertys_arr["property"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $property_item=array(
            "id" => $id,
            "name" => $name,
            "address" => $address,
            "postalcode" => $postalcode,
            "city" => $city,

        );
        array_push($propertys_arr["property"], $property_item);
    }

    echo json_encode($propertys_arr["property"]);
}
else{
    echo json_encode(array());
}
?>
