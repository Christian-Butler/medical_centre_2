<?php

function sanitize_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function validate_title($Title) {
    $pattern = "/^[a-zA-Z-' ]*$/";
    return preg_match($pattern, $title) === 1;
}

function validate_director($director) {
    $pattern = "/^[0-9a-zA-Z-', ]*$/";
    return preg_match($pattern, $director) === 1;
}

function validate_date($date) {
    $pattern = '/^([0-9]{4})\\-([0-9]{2})\\-([0-9]{2})$/';
    $matches = array();
    $valid = (preg_match($pattern, $date, $matches) === 1);
    if ($valid) {
        $valid = (checkdate($matches[2], $matches[3], $matches[1]));
    }
    return $valid;
}

function validate_company($company) {
    return filter_var($company, FILTER_VALIDATE_EMAIL) !== false;
}

function validate_synopsis($synopsis) {
    $pattern = "/^[0-9a-zA-Z-', ]*$/";
    return preg_match($pattern, $synopsis) === 1;
}




function movie_validate($data) {
    $errors = [];
    $movie = [];
    
    //-------------------------------------------------------------------------
    // validate title
    //-------------------------------------------------------------------------
    if (empty($data["Title"])) {
        $errors["Title"] = "The title field is required.";
    }
    else {
        $movie["Title"] = sanitize_input($data["Title"]);
        if (!validate_name($movie["Title"])) {
            $errors["Title"] = "Only letters and spaces are allowed.";
        }
    }
    
    //-------------------------------------------------------------------------
    // validate director
    //-------------------------------------------------------------------------
    if (empty($data["director"])) {
        $errors["director"] = "The director field is required.";
    }
    else {
        $movie["director"] = sanitize_input($data["director"]);
        if (!validate_director($movie["director"])) {
            $errors["director"] = "The title should only have letters, numbers and spaces";
        }
    }
    
    //-------------------------------------------------------------------------
    // validate date
    //-------------------------------------------------------------------------
    if (empty($data["date"])) {
        $errors["date"] = "The date field is required.";
    }
    else {
        $movie["date"] = sanitize_input($data["date"]);
        if (!validate_date($movie["date"])) {
            $errors["date"] = "Invalid date.";
        }
    }
    
    //-------------------------------------------------------------------------
    // validate company
    //-------------------------------------------------------------------------
    if (empty($data["company"])) {
        $errors["company"] = "The Production company field is required.";
    }
    else {
        $movie["company"] = sanitize_input($data["company"]);
        $valid_companies = [
            "Warped Productions",
            "Interstellar Studios",
            "Enclave Animations",
            "Hemlock Studios",
            "Bald Eagle Pictures",
            "Mutual Title Productions"
        ];
        if (!in_array($movie["company"], $valid_companies)) {
            $errors["company"] = "Invalid Production company option";
        }
    }

     //-------------------------------------------------------------------------
    // validate synopsis
    //-------------------------------------------------------------------------
    if (empty($data["synopsis"])) {
        $errors["synopsis"] = "The synopsis field is required.";
    }
    else {
        $movie["synopsis"] = sanitize_input($data["synopsis"]);
        if (!validate_date($movie["synopsis"])) {
            $errors["synopsis"] = "Invalid synopsis.";
        }
    }
    
    //-------------------------------------------------------------------------
    // validate insurance
    //-------------------------------------------------------------------------
    if (empty($data["rating"])) {
        $errors["rating"] = "The rating field is required.";
    }
    else {
        $movie["rating"] = sanitize_input($data["rating"]);
        $valid_rating = ["None", "VHI", "Laya", "Irish Life"];
        if (!in_array($movie["rating"], $valid_rating)) {
            $errors["rating"] = "Invalid rating option";
        }
    }
    
    //-------------------------------------------------------------------------
    // validate preferences
    //-------------------------------------------------------------------------
    if (empty($data["genres"])) {
        echo "testing";
        $errors["genres"] = "The genres field is required.";
    }
    else {
        $movie["genres"] = [];
        foreach ($data["genres"] as $preference) {
            $movie["genres"][] = sanitize_input($preference);
        }
        $valid_preferences = ["Action", "Comedy", "Romance"];
        foreach ($movie["genres"] as $preference) {
            if (!in_array($preference, $valid_preferences)) {
                $errors["genres"] = "Invalid Genres option";
                break;
            }
        }
    }
    
    return [
        $movie,
        $errors
    ];
}


?>