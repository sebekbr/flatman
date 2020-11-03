<?php
// include database and object files
include_once '../config/db.php';
include_once '../objects/landlord.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare landlord object
$landlord = new Landlord($db);
// set ID landlord of landlord to be edited
$landlord->id = isset($_GET['id']) ? $_GET['id'] : die();
// read the details of landlord to be edited
$stmt = $landlord->read_single();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $landlord_arr=array(
        "id" => $row['id'],
        "name" => $row['name'],
        "surname" => $row['surname'],
        "phone" => $row['phone'],
        "email" => $row['email'],
    );
}
// make it json format
print_r(json_encode($landlord_arr));
?>
