<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/houseassociation.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare houseassociation object
$houseassociation = new HouseAssociation($db);

// query houseassociation
$stmt = $houseassociation->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){

    // houseassociations array
    $houseassociations_arr=array();
    $houseassociations_arr["houseassociation"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $houseassociation_item=array(
          "id" => $houseassociation->id,
          "name" => $houseassociation->name,
          "address" => $houseassociation->address,
          "postalcode" => $houseassociation->postalcode,
          "city" => $houseassociation->city,
          "phone" => $houseassociation->phone,
          "email" => $houseassociation->email,
          "comments" => $houseassociation->comments
        );
        array_push($houseassociations_arr["houseassociation"], $houseassociation_item);
    }

    echo json_encode($houseassociations_arr["houseassociation"]);
}
else{
    echo json_encode(array());
}
?>
