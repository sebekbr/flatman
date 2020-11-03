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

// remove the landlord
if($landlord->delete()){
    $landlord_arr=array(
        "status" => true,
        "message" => "Usunięto dane właściciela!"
    );
}
else{
    $landlord_arr=array(
        "status" => false,
        "message" => "Właściciel nie może zostać usunięty. Sprawdź powiązania."
    );
}
print_r(json_encode($landlord_arr));
?>
