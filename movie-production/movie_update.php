<?php
require_once "include/database_connection.php";


require_once "include/patient_validate.php";

if ($_SERVER["REQUEST_METHOD"]){


[$patient, $errors]= patient_validate($_POST);

$patient["id"]= $_POST["id"];

if (empty($errors)) {

}


  // try{
    $sql ="UPDATE patient SET " . 
      "title =:title, " . "director = :director, " . "release_date = :release_date, " . 
      "company =:company,"  . "synopsis = :synopsis, "   . 
      "genre = :genre, " . "rating= :rating,"   .
      "preferences = :preferences" . 
      "WHERE id = :id";
        
  // }

  $params = [
      "id" => $movie["id"],
      "title" => $movie["title"],
      "director" => $movie["director"],
      "release_date"  => $movie["release_date"],
      "company"  => $movie["company"],
      "synopsis"  => $movie["synopsis"],
      "genre"  => $movie["genre"],
      "rating" => $movie["rating"]
  ];

  $stmt=$connection->prepare($sql);
  $success =$stmt->execute();


 if (!$success) {
    throw new Exception("Could not retrieve the medical centre");
  }
}

?>