<?php

require_once("include/movie_validate.php");

require_once "include/database_connection.php";


session_start();
if (isset($_SESSION["data"]) and isset($_SESSION["errors"])) {

    $data = $_SESSION["data"];
    $errors = $_SESSION["errors"];
}
else {
    $data = [];
    $errors = [];
}
try{
    $sql = "SELECT * FROM company";
    

   
    $stmt=$connection->prepare($sql);
    $success =$stmt->execute();
    
    if (!$success) {
        throw new Exception("Could not retrieve the company");
    }

    $companies = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>\$movie = ";
    print_r($companies);
    echo "</pre>";
    
   
}
catch(Exception $e) {
    echo "Error: " .$e->getMessage();
}

echo "<pre>\$data = ";
print_r($data);
echo "</pre>";

echo "<pre>\$errors = ";
print_r($errors);
echo "</pre>";  
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
            <h1 class="heading mb-1">Create new movie</h1>

            <label for="title" class="label">Title</label>
            <input id="title" type="text" name="title" class="narrow" value="<?php if(isset($data["title"])) echo $data["title"];?>">
            <div class="error"><?php if (isset($errors["title"])) echo $errors["title"]; ?></div>

            <label for="director" class="label">Director</label>
            <input id="director" type="text" name="director" class="narrow" value="<?php if(isset($data["director"])) echo $data["director"];  ?>">
            <div class="error"><?php if (isset($errors["director"])) echo $errors["director"]; ?></div>

            <label for="release_date" class="label">Release date</label>
            <input id="release_date" type="date" name="release_date" class="narrow" value="<?php if(isset($data["release_date"])) echo $data["release_date"];  ?>">
            <div class="error"><?php if (isset($errors["release_date"])) echo $errors["release_date"];?></div>

            <label for="company" class="label">Production company</label>
            <div class="wide">
                <select name="company" id="">
                <?php foreach($companies as $company) { ?>
                    <option value="<?= $company['id'] ?>"
                    <?php if (isset($data["company"]) && $data["company"] ==  $company['id']) echo "selected";?>
                    >
                    <?= $company['name'] ?>
                    </option>
                    <?php } ?>


                    <!--<option value="Warped Productions"
                    <?php //if (isset($data["company"]) && $data["company"] == "Warped Productions") echo "selected";?>
                    >
                        Warped Productions
                    </option>
                    <option value="Interstellar Studios"
                    <?php //if (isset($data["company"]) && $data["company"] == "Interstellar Studios") echo "selected";?>
                    >
                        Interstellar Studios
                    </option>
                    <option value="Enclave Animations"
                    <?php // if (isset($data["company"]) && $data["company"] == "Enclave Animations") echo "selected";?>
                    >
                        Enclave Animations
                    </option>
                    <option value="Hemlock Studios"
                    <?php //if (isset($data["company"]) && $data["company"] == "Hemlock Studios") echo "selected";?>
                    >
                        Hemlock Studios
                    </option>
                    <option value="Bald Eagle Pictures"
                    <?php //if (isset($data["company"]) && $data["company"] == "Bald Eagle Studios") echo "selected";?>
                    >
                        Bald Eagle Pictures
                    </option>
                    <option value="Mutual Title Productions"
                    <?php //if (isset($data["company"]) && $data["company"] == "Mutual Title Studios") echo "selected";?>
                    >
                        Mutual Title Productions
                    </option>!-->
                </select>
            </div>
            <div class="error"></div>

            <label for="synopsis" class="label">Synopsis</label>
            <input id="synopsis" type="text" name="synopsis" class="narrow" value="<?php if(isset($data["synopsis"])) echo $data["director"];  ?>">
            <div class="error"><?php if (isset($errors["synopsis"])) echo $errors["synopsis"]; ?></div>

            <label for="rating" class="label">Rating</label>
            <div class="wide">
                <input id="1-star" type="radio" name="rating" value="1"
                <?php if (isset($data["rating"]) && $data["rating"] == "1") echo "checked";?>
                
                >
                <label for="1-star">1 star</label>
                <input id="2-stars" type="radio" name="rating" value="2"
                <?php if (isset($data["rating"]) && $data["rating"] == "2") echo "checked";?>
                
                >
                <label for="2-stars">2 stars</label>
                <input id="3-stars" type="radio" name="rating" value="3"
                <?php if (isset($data["rating"]) && $data["rating"] == "3") echo "checked";?>
                
                >
                <label for="3-stars">3 stars</label>
                <input id="4-stars" type="radio" name="rating" value="4"
                <?php if (isset($data["rating"]) && $data["rating"] == "4") echo "checked";?>
                
                >
                <label for="4-stars">4 stars</label>
                <input id="5-stars" type="radio" name="rating" value="5"
                <?php if (isset($data["rating"]) && $data["rating"] == "5") echo "checked";?>
                
                >
                <label for="5-stars">5 stars</label>
            </div>
            <div class="error"><?php if (isset($errors["rating"])) echo $errors["rating"];?></div>

            <label for="genre" class="label">genre</label>
            <div class="wide">
                <input id="pref-action" type="checkbox" name="genre[]" value="action"
                <?php if (isset($data["genre"]) && in_array("action", $data["genre"])) echo "checked"; ?>
                >
                <label for="pref-action">Action</label>
                <input id="pref-comedy" type="checkbox" name="genre[]" value="comedy"
                <?php if (isset($data["genre"]) && in_array("comedy", $data["genre"])) echo "checked"; ?>
                >
                <label for="pref-comedy">Comedy</label>
                <input id="pref-romance" type="checkbox" name="genre[]" value="romance"
                <?php if (isset($data["genre"]) && in_array("romance", $data["genre"])) echo "checked"; ?>
                >
                <label for="pref-romance">Romance</label>
            </div>
            <div class="error"><?php if (isset($errors["genre"])) echo $errors["genre"];?></div>

            <div class="buttons">
                <button class="button primary" type="submit" formaction="movie_create.php">Create</button>
                <a class="button light" href="movie_view_all.php">Cancel</a>
            </div>
        </form>
    </main>

    <footer class="footer">
        <p>&copy; 2022, all rights reserved.</p>
    </footer>
</body>
</html>
<?php 
if(isset($_SESSION["data"]) and isset($_SESSION["errors"])){
    unset($_SESSION["data"]);
    unset($_SESSION["errors"]);
}
?>