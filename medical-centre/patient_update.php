<?php
require_once "include/database_connection.php"


require_once

if ($_SERVER["REQUEST_METHOD"])


[$patient, $errors]= patient_validate($_POST);

$patient["id"]= $_POST["id"];

if (empty($errors)) {

}


  try[
    $sql ="UPDATE patient SET " . 
      "name =:name, " . "address = :address, " . "phone = :phone, " . 
      "email =:email,"  . "dob = :dob, "   . 
      "centre_id = :centre_id, " . "insurance= :insurance,"   .
      "preferences = :preferences" . 
      "WHERE id = :id";
        
  ]

  $params = [
      "id" => $patient["id"],
      "name" => $patient["name"],
      "address" => $patient["address"],
      "phone"  => $patient["phone"],
      "email"  => $patient["email"],
      "dob"  => $patient["dob"],
      "centre_id"  => $patient["centre_id"],
      "insurance"  => $patient["insurance"],
      "preferences"  => $patient["preferences"]
  ];

  $stmt=$connection->prepare($sql);
 $success =$stmt->execute();


 if (!$success) {
    throw new Exception("Could not retrieve the medical centre");
  }


