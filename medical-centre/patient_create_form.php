<?php


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
    $sql = "SELECT * FROM medical_centre";
    

   
    $stmt=$connection->prepare($sql);
    $success =$stmt->execute();
    
    if (!$success) {
        throw new Exception("Could not retrieve the medical centre");
    }

    $centres = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>\$centres = ";
    // print_r($centres);
    // echo "</pre>";
    
   
}
catch(Exception $e) {
    echo "Error: " .$e->getMessage();
}

// echo "<pre>\$data = ";
// print_r($data);
// echo "</pre>";

// echo "<pre>\$errors = ";
// print_r($errors);
// echo "</pre>";  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/main.css">
    <title>ABC HealthCare</title>
</head>
<body class="container flex flex-column">
    <header class="header"></header>

    <nav>
        <div class="nav">
            <a href="index.php" class="nav-item">Home</a>
            <a href="centre_view_all.php" class="nav-item">centres</a>
            <a href="patient_view_all.php" class="nav-item">Patients</a>
            <a href="contact_us.php" class="nav-item">Contact</a>
            <a href="about_us.php" class="nav-item">About</a>
        </div>
    </nav>

    <main class="main">
        <form method="post" class="form">
            <h1 class="heading mb-1">Create new patient</h1>

            <label for="name" class="label">Name</label>
            <input id="name" type="text" name="name" class="narrow" value="<?php if(isset($data["name"])) echo $data["name"];  ?>">
            <div class="error"><?php if (isset($errors["name"])) echo $errors["name"]; ?></div>

            <label for="address" class="label">Address</label>
            <input id="address" type="text" name="address" class="wide" value="<?php if(isset($data["address"])) echo $data["address"];  ?>">
            <div class="error"><?php if (isset($errors["address"])) echo $errors["address"]; ?></div>

            <label for="phone" class="label">Phone</label>
            <input id="phone" type="tel" name="phone" class="narrow" value="<?php if(isset($data["phone"])) echo $data["phone"];  ?>">
            <div class="error"><?php if (isset($errors["phone"])) echo $errors["phone"]; ?></div>

            <label for="email" class="label">Email</label>
            <input id="email" type="email" name="email" class="wide" value="<?php if(isset($data["email"])) echo $data["email"];  ?>">
            <div class="error"><?php if (isset($errors["email"])) echo $errors["email"]; ?></div>

            <label for="dob" class="label">Date of birth</label>
            <input id="dob" type="date" name="dob" class="narrow" value="<?php if(isset($data["dob"])) echo $data["dob"];  ?>">
            <div class="error"><?php if (isset($errors["dob"])) echo $errors["dob"]; ?></div>

            <label for="centre" class="label">Medical centre</label>
            <div class="wide">
                <select id="centre" name="centre">
                <?php foreach($centres as $centre) { ?>
                    <option value="<?= $centre['id'] ?>"
                    <?php if (isset($data["centre"]) && $data["centre"] ==  $centre['id']) echo "selected";?>
                    >
                    <?= $centre['title'] ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
            <div class="error"></div>

            <label for="insurance" class="label">Insurance</label>
            <div class="wide">
                <input id="insure-none" type="radio" name="insurance" value="None"
                <?php if (isset($data["insurance"]) && $data["insurance"] == "None") echo "checked";?>
                
                >
                <label for="insure-none">None</label>
                <input id="insure-vhi" type="radio" name="insurance" value="VHI"
                <?php if (isset($data["insurance"]) && $data["insurance"] == "VHI") echo "checked";?>
                
                >
                <label for="insure-vhi">VHI</label>
                <input id="insure-laya" type="radio" name="insurance" value="Laya"
                <?php if (isset($data["insurance"]) && $data["insurance"] == "Laya") echo "checked";?>
                
                >
                <label for="insure-laya">Laya</label>
                <input id="insure-irish-life" type="radio" name="insurance" value="Irish Life"
                <?php if (isset($data["insurance"]) && $data["insurance"] == "Irish Life") echo "checked";?>
                
                >
                <label for="insure-irish-life">Irish Life</label>
            </div>
            <div class="error"></div>

            <label for="preferences" class="label">Communication preferences</label>
            <div class="wide">

           
                <input id="pref-email" type="checkbox" name="preferences[]" value="Email"
                 <?php if (isset($data["preferences"]) && in_array("Email", $data["preferences"])) echo "checked"; ?>
                >
                <label for="pref-email">Email</label>
                <input id="pref-phone" type="checkbox" name="preferences[]" value="Phone"
                <?php if (isset($data["preferences"]) && in_array("Phone", $data["preferences"])) echo "checked";?>
                >
                <label for="pref-phone">Phone</label>
                <input id="pref-post" type="checkbox" name="preferences[]" value="Post"
                <?php if (isset($data["preferences"]) && in_array("Post", $data["preferences"])) echo "checked";?>
                >
                <label for="pref-post">Post</label>
            </div>
            <div class="error"></div>

            <div class="buttons">
                <button class="button primary" type="submit" formaction="patient_create.php">Create</button>
                <a class="button light" href="patient_view_all.php">Cancel</a>
            </div>
        </form>
    </main>

    <footer class="footer">
        <p>&copy; 2022, all rights reserved.</p>
    </footer>
</body>
</html>