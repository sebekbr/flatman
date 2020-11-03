<?php

// include database and object files
include_once '../config/db.php';
include_once '../objects/tenant.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare tenant object
$tenant = new tenant($db);

// set tenant tenant values
$tenant->name = $_POST['name'];
$tenant->surname = $_POST['surname'];
$tenant->address = $_POST['address'];
$tenant->postalcode = $_POST['postalcode'];
$tenant->city = $_POST['city'];
$tenant->phone = $_POST['phone'];
$tenant->email = $_POST['email'];
$tenant->comments = $_POST['comments'];

// create the tenant
if($tenant->update()){
    $tenant_arr=array(
        "status" => true,
        "message" => "Zaktualizowano!"
    );
}
else{
    $tenant_arr=array(
        "status" => false,
        "message" => "address already exists!"
    );
}
print_r(json_encode($tenant_arr));
?>
