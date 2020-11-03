<?php

// include database and object files
include_once '../config/db.php';
include_once '../objects/tenant.php';
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare tenant object
$tenant = new Tenant($db);

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
if($tenant->create()){
    $tenant_arr=array(
        "status" => true,
        "message" => "Pomyślnie dodano",
        "id" => $tenant->id,
        "name" => $tenant->name,
        "surname" => $tenant->surname,
        "address" => $tenant->address,
        "postalcode" => $tenant->postalcode,
        "city" => $tenant->city,
        "phone" => $tenant->phone,
        "email" => $tenant->email,
        "comments => $tenant->comments
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
