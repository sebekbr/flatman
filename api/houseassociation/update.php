<?php

// include database and object files
include_once '../config/db.php';
include_once '../objects/houseassociation.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare houseassociation object
$houseassociation = new HouseAssociation($db);

// set houseassociation houseassociation values
$houseassociation->name = $_POST['name'];
$houseassociation->address = $_POST['address'];
$houseassociation->postalcode = $_POST['phone'];
$houseassociation->city = $_POST['city'];
$houseassociation->phone = $_POST['phone'];
$houseassociation->email = $_POST['email'];
$houseassociation->comments = $_POST['comments'];

// create the houseassociation
if($houseassociation->update()){
    $houseassociation_arr=array(
        "status" => true,
        "message" => "Zaktualizowano!"
    );
}
else{
    $houseassociation_arr=array(
        "status" => false,
        "message" => "address already exists!"
    );
}
print_r(json_encode($houseassociation_arr));
?>
