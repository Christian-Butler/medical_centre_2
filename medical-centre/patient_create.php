<?php
require_once "include/database_connection.php";

require_once "include/patient_validate.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // echo "Process request!!";

    // echo "<pre>\$_POST = ";
    // print_r($_POST);
    // echo "</pre>";

    [$patient, $errors] = patient_validate($_POST);

    if (empty($errors)) {
        $sql ="INSERT INTO patient" . 
         "(name, address, phone,email,dob,centre_id, insurance, preferences) VALUES " . 
         "(:name, :address, :phone, :email,:dob, :centre_id, :insurance, :preferences)";

        $params = [
            "name" => $patient["name"],
            "address" => $patient["address"],
            "phone" => $patient["phone"],
            "email" => $patient["email"],
            "dob" => $patient["dob"],
            "centre_id" => $patient["centre"],
            "insurance" => $patient["insurance"],
            "preferences" => implode(",",$patient ["preferences"])
        ];
        // echo "<pre>\$patient = ";
        // print_r($patient);
        // echo "</pre>";
        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);

        if(!$success){
            throw new Exception("Could not insert new patient");
        }
    
        // echo "<pre>\$errors = ";
        // print_r($errors);
        // echo "</pre>";
        header("Location: patient_view_all.php");
    }
    else {
        session_start();
        $_SESSION["data"] = $patient;
        $_SESSION["errors"] = $errors;
        header("Location: patient_create_form.php");
    }
}
else {
    http_response_code(405);
}
?>