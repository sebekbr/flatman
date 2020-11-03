<?php

// include database and object files
include_once '../config/db.php';
include_once '../objects/landlord.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare landlord object
$landlord = new Landlord($db);

// set landlord landlord values
$landlord->id = $_POST['id'];
$landlord->name = $_POST['name'];
$landlord->surname = $_POST['surname'];
$landlord->phone = $_POST['phone']);
$landlord->email = $_POST['email'];

// create the landlord
if($landlord->update()){
    $landlord_arr=array(
        "status" => true,
        "message" => "Zaktualizowano!"
    );
}
else{
    $landlord_arr=array(
        "status" => false,
        "message" => "address already exists!"
    );
}
print_r(json_encode($landlord_arr));
?>
