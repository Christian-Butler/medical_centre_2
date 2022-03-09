<?php

require_once("include/movie_validate.php");

require "include/database_connection.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "Process request!!";

    echo "<pre>\$_POST = ";
    print_r($_POST);
    echo "</pre>";

    [$movie, $errors] = movie_validate($_POST);

    if (empty($errors)) {

        try {
            $company_id = intval($movie['company']);
            //$movie = implode(',' ,$movie['movie']);
        
        

        $params = array (
            "title" => $movie["title"],
            "director" => $movie["director"],
            "release_date" => $movie["release_date"],
            "company" => $movie["company"],
            "synopsis" => $movie["synopsis"],
            "genre" => implode(',',$movie["genre"]),
            "rating" => intval($movie["rating"])
            
        );

        $sql ="INSERT INTO movie" . 
         "(title, director, release_date,company,synopsis,genre, rating) VALUES " . 
         "(:title, :director, :release_date, :company,:synopsis, :genre, :rating)";

        $stmt = $connection->prepare($sql);
        $success = $stmt->execute($params);

        if(!$success){
            throw new Exception("Could not insert new movie");
        }
    
        
        //header("Location: movie_view_all.php");
    }
    catch(PDOException $e){
        echo "Error " . $e->getMessage();
    }
    
    $connection = null;
        echo "<pre>\$movie = ";
        print_r($movie);
        echo "</pre>";
    
        echo "<pre>\$errors = ";
        print_r($errors);
        echo "</pre>";
    }
    else {
        session_start();
        $_SESSION["data"] = $movie;
        $_SESSION["errors"] = $errors;
        header("Location: movie_create_form.php");
    }
}
else {
    http_response_code(405);
}
?>