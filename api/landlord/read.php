<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/landlord.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare landlord object
$landlord = new Landlord($db);

// query landlord
$stmt = $landlord->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){

    // landlords array
    $landlords_arr=array();
    $landlords_arr["landlord"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $landlord_item=array(
            "id" => $id,
            "name" => $name,
            "surname" => $surname,
            "phone" => $phone,
            "email" => $email,

        );
        array_push($landlords_arr["landlord"], $landlord_item);
    }

    echo json_encode($landlords_arr["landlord"]);
}
else{
    echo json_encode(array());
}
?>
