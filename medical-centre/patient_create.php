<?php
require_once "include/database_connection.php";

require_once "include/patient_validate.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "Process request!!";

    echo "<pre>\$_POST = ";
    print_r($_POST);
    echo "</pre>";

    

    [$patient, $errors] = patient_validate($_POST);

    echo "<pre>\$errors = ";
        print_r($errors);
        echo "</pre>";

        echo "<pre>\$patient = ";
        print_r($patient);
        echo "</pre>";

    if (empty($errors)) {

        try {
            $center_id = intval($patient['centre']);
            $preferences = implode(',' ,$patient['preferences']);
        
        

        $params = array (
            "name" => $patient["name"],
            "address" => $patient["address"],
            "phone" => $patient["phone"],
            "email" => $patient["email"],
            "dob" => $patient["dob"],
            "centre" => $patient["centre"],
            "insurance" => $patient["insurance"],
            "preferences" => $preferences
        );

        $sql ="INSERT INTO patient" . 
         "(name, address, phone,email,dob,centre, insurance, preferences) VALUES " . 
         "(:name, :address, :phone, :email,:dob, :centre, :insurance, :preferences)";

        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);

        if(!$success){
            throw new Exception("Could not insert new patient");
        }
    
        
        //header("Location: patient_view_all.php");
    }
    catch(PDOException $e){
        echo "Error " . $e->getMessage();
    }
    
    $connection = null;
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