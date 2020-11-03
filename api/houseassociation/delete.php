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
$houseassociation->id = $_POST['id'];

// remove the houseassociation
if($houseassociation->delete()){
    $houseassociation_arr=array(
        "status" => true,
        "message" => "Usunięto spółdzielnię!"
    );
}
else{
    $houseassociation_arr=array(
        "status" => false,
        "message" => "Spółdzielnia nie może zostać usunięta. Sprawdź powiązania."
    );
}
print_r(json_encode($houseassociation_arr));
?>
