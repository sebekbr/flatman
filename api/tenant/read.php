<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/tenant.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare tenant object
$tenant = new Tenant($db);

// query tenant
$stmt = $tenant->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){

    // tenants array
    $tenants_arr=array();
    $tenants_arr["tenant"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $tenant_item=array(
            "id" => $id,
            "name" => $name,
            "surname" => $surname,
            "address" => $address,
            "postalcode" => $postalcode,
            "city" => $city,
            "phone" => $phone,
            "email" => $email,
            "comments" => $comments
        );
        array_push($tenants_arr["tenant"], $tenant_item);
    }

    echo json_encode($tenants_arr["tenant"]);
}
else{
    echo json_encode(array());
}
?>
