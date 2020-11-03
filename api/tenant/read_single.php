<?php
// include database and object files
include_once '../config/db.php';
include_once '../objects/tenant.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare tenant object
$tenant = new Tenant($db);
// set ID tenant of tenant to be edited
$tenant->id = isset($_GET['id']) ? $_GET['id'] : die();
// read the details of tenant to be edited
$stmt = $tenant->read_single();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $tenant_arr=array(
        "id" => $row['id'],
        "name" => $row['name'],
        "surname" => $row['surname'],
        "address" => $row['address'],
        "postalcode" => $row['postalcode'],
        "city" => $row['city'],
        "phone" => $row['phone'],
        "email" => $row['email'],
        "comments" => $row['comments'],
    );
}
// make it json format
print_r(json_encode($tenant_arr));
?>
