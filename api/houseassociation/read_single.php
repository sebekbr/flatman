<?php
// include database and object files
include_once '../config/db.php';
include_once '../objects/houseassociation.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare houseassociation object
$houseassociation = new HouseAssociation($db);
// set ID houseassociation of houseassociation to be edited
$houseassociation->id = isset($_GET['id']) ? $_GET['id'] : die();
// read the details of houseassociation to be edited
$stmt = $houseassociation->read_single();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $houseassociation_arr=array(
        "id" => $row['id'],
        "name" => $row['name'],
        "address" => $row['address'],
        "postalcode" => $row['postalcode'],
        "city" => $row['city'],
        "phone" => $row['phone'],
        "email" => $row['email'],
        "comments" => $row['comments']
    );
}
// make it json format
print_r(json_encode($houseassociation_arr));
?>
