<?php
require_once "include/database_connection.php";
session_start();
if (isset($_SESSION["data"]) and isset($_SESSION["errors"]))
{
    $data=$_SESSION["data"];
    $errors=$_SESSION["errors"];
}
else {

    try {
    $movie_id =$_POST['movie_id'];
    $sql ="SELECT * FROM patient WHERE id = :id";

    $params = [
        "id" => $patient_id
    ];

    $stmt = $connection->prepare($sql);
    $success = $stmt->execute($params);

    if (!$success) 
    {
        throw new Exception("Could not retrieve selected movie");
    }
    else{
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $data['preferences'] = explode(",", $data['preferences']);
    }
}
    catch(Exception $e) {
        echo "Error: " .$e->getMessage();
    }

    $errors = [];

    try{
        $sql = "SELECT * FROM movie_production";
        $stmt=$connection->prepare($sql);
        $success =$stmt->execute();
            
        if (!$success) {
            throw new Exception("Could not retrieve the movie");
        }
        else {
            $centres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }
    catch(Exception $e) {
        echo "Error: " .$e->getMessage();
    }
    
    
    // echo "<pre>\$centres = ";
    // print_r($centres);
    // echo "</pre>";
        
    
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/main.css">
    <title>Peak Talent Management</title>
</head>
<body class="container flex flex-column">
    <header class="header"></header>

    <nav>
        <div class="nav">
            <a href="index.php" class="nav-item">Home</a>
            <a href="company_view_all.php" class="nav-item">Companies</a>
            <a href="movie_view_all.php" class="nav-item">Movies</a>
            <a href="contact_us.php" class="nav-item">Contact</a>
            <a href="about_us.php" class="nav-item">About</a>
        </div>
    </nav>

    <main class="main">
        <form method="post" class="form">
            <h1 class="heading mb-1">Delete existing movie</h1>

            <label for="title" class="label">Title</label>
            <input id="title" type="text" name="title" class="narrow" value="<?php if (isset($data["title"])) echo $data["title"]; ?>" disabled>
            <div class="error"><?php if (isset($errors["title"])) echo $errors["title"]; ?></div>

            <label for="director" class="label">Director</label>
            <input id="director" type="text" name="director" class="narrow" value="<?php if (isset($data["director"])) echo $data["director"]; ?>" disabled>
            <div class="error"><?php if (isset($errors["director"])) echo $errors["director"]; ?></div>

            <label for="release_date" class="label">Release date</label>
            <input id="release_date" type="date" name="release_date" class="narrow" value="<?php if (isset($data["release_date"])) echo $data["release_date"]; ?>" disabled>
            <div class="error"><?php if (isset($errors["release_date"])) echo $errors["release_date"]; ?></div>

            <label for="company" class="label">Production company</label>
            <div class="wide">
                <select name="company" id="" disabled>
                <?php
                     
                     foreach($companies as $company){
                      echo $company['id'];

                      echo"<option value=".$company['id']."'";
                      if (isset($data["company"]) && $data["company"] ==['id']) echo "selected";
                      
                      echo ">";
                      echo $centre['title'];
                      echo "</option>";
                     }
                    // <!-- <option value="Warped Productions">
                    //     Warped Productions
                    // </option>
                    // <option value="Interstellar Studios">
                    //     Interstellar Studios
                    // </option>
                    // <option value="Enclave Animations">
                    //     Enclave Animations
                    // </option>
                    // <option value="Hemlock Studios">
                    //     Hemlock Studios
                    // </option>
                    // <option value="Bald Eagle Pictures">
                    //     Bald Eagle Pictures
                    // </option>
                    // <option value="Mutual Title Productions">
                    //     Mutual Title Productions
                    // </option> -->
                    ?>
                </select>
            </div>
            <div class="error"><?php if (isset($errors["company"])) echo $errors["company"]; ?></div>
            <label for="synopsis" class="label">Synopsis</label>
            <input id="synopsis" type="tel" name="synopsis" class="wide" value="<?php if (isset($errors["synopsis"])) echo $errors["synopsis"]; ?>" disabled>
            <div class="error"></div>

            <label for="rating" class="label">Rating</label>
            <div class="wide">
                <input id="1-star" type="radio" name="rating" value="1"<?php if (isset($data["1-star"]) && $data["1-star"] == "None") echo "checked";  ?> disabled>
                <label for="1-star">1 star</label>
                <input id="2-stars" type="radio" name="rating" value="2" <?php if (isset($data["2-star"]) && $data["2-star"] == "None") echo "checked";  ?> disabled>
                <label for="2-stars">2 stars</label>
                <input id="3-stars" type="radio" name="rating" value="3" <?php if (isset($data["3-star"]) && $data["3-star"] == "None") echo "checked";  ?> disabled>
                <label for="3-stars">3 stars</label>
                <input id="4-stars" type="radio" name="rating" value="4" <?php if (isset($data["4-star"]) && $data["4-star"] == "None") echo "checked";  ?> disabled>
                <label for="4-stars">4 stars</label>
                <input id="5-stars" type="radio" name="rating" value="5" <?php if (isset($data["5-star"]) && $data["5-star"] == "None") echo "checked";  ?> disabled>
                <label for="5-stars">5 stars</label>
            </div>
            <div class="error"></div>

            <label for="genre" class="label">genre</label>
            <div class="wide">
                <input id="pref-action" type="checkbox" name="genre[]" value="action" <?php if (isset($data["genre[]"]) && in_array("pref-action", $data["genre[]"])) echo "checked"; ?>>
                <label for="pref-action">Action</label>
                <input id="pref-comedy" type="checkbox" name="genre[]" value="comedy" <?php if (isset($data["genre[]"]) && in_array("pref-comedy", $data["genre[]"])) echo "checked"; ?>>
                <label for="pref-comedy">Comedy</label>
                <input id="pref-romance" type="checkbox" name="genre[]" value="romance" <?php if (isset($data["genre[]"]) && in_array("pref-romance", $data["preferences"])) echo "checked"; ?>>
                <label for="pref-romance">Romance</label>
            </div>
            <div class="error"><?php if (isset($errors["preferences"]) && in_array("Post", $errors["gnere"])) echo $errors["gnere"]; ?></div>

            <div class="buttons">
                <button class="button primary" type="submit" formaction="movie_delete.php">Delete</button>
                <a class="button light" href="movie_view_all.php">Cancel</a>
            </div>
            <input type="hidden" name = "id" value = "<?= $movie_id ?>">
        </form>
    </main>

    <footer class="footer">
        <p>&copy; 2022, all rights reserved.</p>
    </footer>
</body>
</html>