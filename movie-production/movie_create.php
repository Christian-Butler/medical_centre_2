<?php

require_once("include/patient_validate.php");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "Process request!!";

    echo "<pre>\$_POST = ";
    print_r($_POST);
    echo "</pre>";

    [$patient, $errors] = patient_validate($_POST);

    if (empty($errors)) {
        echo "<pre>\$patient = ";
        print_r($patient);
        echo "</pre>";
    
        echo "<pre>\$errors = ";
        print_r($errors);
        echo "</pre>";
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