<?php 
session_start();
if (isset($_SESSION["data"])) {
    $data = $_SESSION["data"];
    $errors = $_SESSION["errors"];
}
else {
    $data = [];
    $errors = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Comment form</title>
</head>
<body>
    <?php 
    echo "<pre>\$data = "; print_r($data); echo "</pre>";
    echo "<pre>\$errors = "; print_r($errors); echo "</pre>";
    ?>
    <form id="comment_form" method="post" action="comment_submit.php">
        <p>
            Name: 
            <input id="name" name="name" 
                value="<?php if (isset($data["name"])) echo $data["name"]; ?>"
            >
            <span  class="error"><?php if (isset($errors["name"])) echo $errors["name"]; ?><span>
        </p>
        <p>
            Category:
            <select name="category">
            <option value="blank">Please choose one</option>
                <option value="Sport"
                    <?php if (isset($data['category']) and $data['category'] === 'Sport')  echo 'selected'; ?>
                >
                    Sport
                </option>
                <option value="Music"  
                    <?php if (isset($data['category']) and $data['category'] === 'Music')  echo 'selected'; ?>
                >
                    Music
                </option>
                <option value="Movies" 
                    <?php if (isset($data['category']) and $data['category'] === 'Movies') echo 'selected'; ?>
                >
                    Movies
                </option>
            </select>
            <span  id="category_error" class="error"><?php if (isset($errors["category"])) echo $errors["category"]; ?><span>
        </p>
        <p>
            Experience:
            <input type="radio" name="experience" value="Novice"    
                <?php if (isset($data['experience']) and $data['experience'] === 'Novice')    echo 'checked'; ?>
            >
            Novice
            <input type="radio" name="experience" value="Competent" 
                <?php if (isset($data['experience']) and $data['experience'] === 'Competent') echo 'checked'; ?>
            >
            Competent
            <input type="radio" name="experience" value="Expert"    
                <?php if (isset($data['experience']) and $data['experience'] === 'Expert')    echo 'checked'; ?>
            >
            Expert
            <span  id="experience_error" class="error"><?php if (isset($errors["experience"])) echo $errors["experience"]; ?><span>
        </p>
        <p>
            Languages:
            <input type="checkbox" name="languages[]" value="English" 
                <?php if (isset($data['languages']) and in_array('English', $data['languages'])) echo 'checked'; ?>
            >
            English
            <input type="checkbox" name="languages[]" value="Irish"   
                <?php if (isset($data['languages']) and in_array('Irish',   $data['languages'])) echo 'checked'; ?>
            >
            Irish
            <input type="checkbox" name="languages[]" value="Spanish" 
                <?php if (isset($data['languages']) and in_array('Spanish', $data['languages'])) echo 'checked'; ?>
            >
            Spanish
            <span id="languages_error" class="error"><?php if (isset($errors["languages"])) echo $errors["languages"]; ?><span>
        </p>
        <button id="submit_btn" type="submit">Submit</button>
    </form>
   <script src="js/validate.js"></script>
</body>
</html>
<?php 
if (isset($_SESSION["data"]) and isset($_SESSION["errors"])) {
    unset($_SESSION["data"]);
    unset($_SESSION["errors"]);
}
?>