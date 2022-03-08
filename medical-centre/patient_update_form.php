<?php
require_once "include/database_connection.php";
session_start();
if (isset($_SESSION["data"]) and isset($_SESSION["errors"]))
{
    $data=$_SESSION["data"];
    $errors=$_SESSION["errors"];
}
else {
    $patient_id =$_POST['patient_id'];
    $sql ="SELECT * FROM patient WHERE id = :id";

    $params = [
        "id" => $patient_id
    ];

    $stmt = $connection->prepare($sql);
    $success = $stmt->execute($params);

    if (!$success) 
    {
        throw new Exception("Could not retrieve selected patient");
    }

    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    $data['preferences'] = explode(",", $data['preferences']);
    $errors =[];

    
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
            <a href="centre_view_all.php" class="nav-item">Centres</a>
            <a href="patient_view_all.php" class="nav-item">Patients</a>
            <a href="contact_us.php" class="nav-item">Contact</a>
            <a href="about_us.php" class="nav-item">About</a>
        </div>
    </nav>

    <main class="main">
        <form method="post" class="form">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <h1 class="heading mb-1">Update existing patient</h1>

            <label for="name" class="label">Name</label>
            <input id="name" type="text" name="name" class="narrow" value="<?php if (isset($data["name"])) echo $data["name"];?>">
            <div class="error"></div>

            <label for="address" class="label">Address</label>
            <input id="address" type="text" name="address" class="wide" value="<?php if (isset($data["address"])) echo $data["address"];?>">
            <div class="error"></div>

            <label for="phone" class="label">Phone</label>
            <input id="phone" type="tel" name="phone" class="narrow" value="<?php if (isset($data["phone"])) echo $data["phone"];?>">
            <div class="error"></div>

            <label for="email" class="label">Email</label>
            <input id="email" type="email" name="email" class="wide" value="<?php if (isset($data["email"])) echo $data["email"];?>">
            <div class="error"></div>

            <label for="dob" class="label">Date of birth</label>
            <input id="dob" type="date" name="dob" class="narrow" value="<?php if (isset($data["dob"])) echo $data["dob"];?>">
            <div class="error"></div>

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
                <input id="insure-none" type="radio" name="insurance" value="None">
                <label for="insure-none">None</label>
                <input id="insure-vhi" type="radio" name="insurance" value="VHI">
                <label for="insure-vhi">VHI</label>
                <input id="insure-laya" type="radio" name="insurance" value="Laya">
                <label for="insure-laya">Laya</label>
                <input id="insure-irish-life" type="radio" name="insurance" value="Irish Life">
                <label for="insure-irish-life">Irish Life</label>
            </div>
            <div class="error"></div>

            <label for="preferences" class="label">Communication preferences</label>
            <div class="wide">
                <input id="pref-email" type="checkbox" name="preferences[]" value="Email">
                <label for="pref-email">Email</label>
                <input id="pref-phone" type="checkbox" name="preferences[]" value="Phone">
                <label for="pref-phone">Phone</label>
                <input id="pref-post" type="checkbox" name="preferences[]" value="Post">
                <label for="pref-post">Post</label>
            </div>
            <div class="error"></div>

            <div class="buttons">
                <button class="button primary" type="submit" formaction="patient_update.php">Update</button>
                <a class="button light" href="patient_view_all.php">Cancel</a>
            </div>
        </form>
    </main>

    <footer class="footer">
        <p>&copy; 2022, all rights reserved.</p>
    </footer>
</body>
</html>