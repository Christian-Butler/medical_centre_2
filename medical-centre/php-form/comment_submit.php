<?php

function sanitize_input($input_data) {
    $input_data = trim($input_data);
    $input_data = stripcslashes($input_data);
    $input_data = htmlspecialchars($input_data);
    return $input_data;
}

echo "<pre>\$_POST = "; print_r($_POST); echo "</pre>";

$data = [];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST["name"])) {
        $errors["name"] = "Name is required.";
    }
    else {
        $data["name"] = sanitize_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/",$data["name"])) {
            $errors["name"] = "Name can only contain letters and white space.";
        }
    }
    if (empty($_POST["category"])) {
        $errors["category"] = "Category is required.";
    }
    else {
        $data["category"] = sanitize_input($_POST["category"]);
        $valid_categories = ["Sport", "Music", "Movies"];
        if (!in_array($data['category'], $valid_categories)) {
            $errors["category"] = "Category must be one of Sport, Music or Movies.";
        }
    }
    if (!isset($_POST["experience"])) {
        $errors["experience"] = "Experience is required.";
    }
    else {
        $valid_experiences = ["Novice", "Competent", "Expert"];
        $data["experience"] = sanitize_input($_POST["experience"]);
        if (!in_array($data['experience'], $valid_experiences)) {
            $errors["experience"] = "Experience must be one of Novice, Competent or Expert.";
        }
    }
    if (isset($_POST["languages"])) {
        $valid_languages = ["English", "Irish", "Spanish"];
        $data["languages"] = [];
        foreach ($_POST["languages"] as $language) {
            $data["languages"][] = sanitize_input($language);
        }
        foreach ($data["languages"] as $language) {
            if (!in_array($language, $valid_languages)) {
                $errors["languages"] = "Languages must be one of English, Irish or Spanish.";
                break;
            }
        }
    }
    else {
        $data["languages"] = null;
    }
    
    if (empty($errors)) {
        echo "<pre>\$data = "; print_r($data); echo "</pre>";
        echo "<pre>\$errors = "; print_r($errors); echo "</pre>";
    }
    else {
        session_start();
        $_SESSION["data"] = $_POST;
        $_SESSION["errors"] = $errors;

        header("Location: comment_form.php");
    }
}
else {
    // set the response status code to 405 (Method not allowed)
    http_response_code(405);
}
?>
