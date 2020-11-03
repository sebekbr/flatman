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
$landlord->name = $_POST['name'];
$landlord->surname = $_POST['surname'];
$landlord->phone = $_POST['phone'];
$landlord->email = $_POST['email'];

// create the landlord
if($landlord->create()){
    $landlord_arr=array(
        "status" => true,
        "message" => "Pomyślnie dodano",
        "id" => $landlord->id,
        "name" => $landlord->name,
        "surname" => $landlord->surname,
        "phone" => $landlord->phone,
        "email" => $landlord->email
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
