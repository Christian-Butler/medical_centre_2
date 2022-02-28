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
            <div class="error"></div>

            <label for="director" class="label">Director</label>
            <input id="director" type="text" name="director" class="narrow" value="<?php if(isset($data["director"])) echo $data["director"];  ?>">
            <div class="error"></div>

            <label for="released" class="label">Release date</label>
            <input id="released" type="date" name="released" class="narrow" value="<?php if(isset($data["released"])) echo $data["released"];  ?>">
            <div class="error"></div>

            <label for="company" class="label">Production company</label>
            <div class="wide">
                <select name="company" id="">
                    <option value="Warped Productions"
                    <?php if (isset($data["company"]) && $data["company"] == "Warped Productions") echo "selected";?>
                    >
                        Warped Productions
                    </option>
                    <option value="Interstellar Studios"
                    <?php if (isset($data["company"]) && $data["company"] == "Interstellar Studios") echo "selected";?>
                    >
                        Interstellar Studios
                    </option>
                    <option value="Enclave Animations"
                    <?php if (isset($data["company"]) && $data["company"] == "Enclave Animations") echo "selected";?>
                    >
                        Enclave Animations
                    </option>
                    <option value="Hemlock Studios"
                    <?php if (isset($data["company"]) && $data["company"] == "Hemlock Studios") echo "selected";?>
                    >
                        Hemlock Studios
                    </option>
                    <option value="Bald Eagle Pictures"
                    <?php if (isset($data["company"]) && $data["company"] == "Bald Eagle Studios") echo "selected";?>
                    >
                        Bald Eagle Pictures
                    </option>
                    <option value="Mutual Title Productions"
                    <?php if (isset($data["company"]) && $data["company"] == "Mutual Title Studios") echo "selected";?>
                    >
                        Mutual Title Productions
                    </option>
                </select>
            </div>
            <div class="error"></div>

            <label for="synopsis" class="label">Synopsis</label>
            <input id="synopsis" type="tel" name="synopsis" class="wide" value="">
            <div class="error"></div>

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
            <div class="error"></div>

            <label for="genres" class="label">Genres</label>
            <div class="wide">
                <input id="pref-action" type="checkbox" name="genres[]" value="action"
                <?php if (isset($data["genres"]) && in_array("action", $data["genres"])) echo "checked"; ?>
                >
                <label for="pref-action">Action</label>
                <input id="pref-comedy" type="checkbox" name="genres[]" value="comedy"
                <?php if (isset($data["genres"]) && in_array("comedy", $data["genres"])) echo "checked"; ?>
                >
                <label for="pref-comedy">Comedy</label>
                <input id="pref-romance" type="checkbox" name="genres[]" value="romance"
                <?php if (isset($data["genres"]) && in_array("romance", $data["genres"])) echo "checked"; ?>
                >
                <label for="pref-romance">Romance</label>
            </div>
            <div class="error"></div>

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