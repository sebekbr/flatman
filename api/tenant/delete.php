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
$tenant->id = $_POST['id'];

// remove the tenant
if($tenant->delete()){
    $tenant_arr=array(
        "status" => true,
        "message" => "Usunięto dane najemcę!"
    );
}
else{
    $tenant_arr=array(
        "status" => false,
        "message" => "Najemca nie może zostać usunięty. Sprawdź powiązania."
    );
}
print_r(json_encode($tenant_arr));
?>
