<?php

require_once "include/database_connection.php";

try
{
    $params = array(
        'id' =>$_POST['id']
    );
    $sql = 'SELECT * FROM patient WHERE id = :id';

    $stmt = $connection->prepare($sql);
    $success = $stmt->execute($params);
    if (!success  ) {
        throw new Exception("Failed to retrieve patient");
    }
    else {
        $data = $stat->fetch();
    }
}
catch (PDOException $e){
    echo "Error: " . $e->getMessage();
}

try{
    $sql = 'SELECT * FROM medical_centre';
    $stmt = $connection->prepare($sql);
    $success=$stmt->execute();
    if (!$success) {
        throw new Exception("Failed to retrieve centres");
    }
    else {
        $centres = $stmt->fetchAll();
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$getconnection

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
            <h1 class="heading mb-1">Delete existing patient</h1>

            <label for="name" class="label">Name</label>
            <input id="name" type="text" name="name" class="narrow" disabled value="<?php if (isset($data ?>" >
            <div class="error"><?php if (isset($errors["name"])) echo $errors["name"]; ?></div>

            <label for="address" class="label">Address</label>
            <input id="address" type="text" name="address" class="wide" disabled value="">
            <div class="error"><?php if (isset($errors["address"])) echo $errors["address"]; ?></div> 

            <label for="phone" class="label">Phone</label>
            <input id="phone" type="tel" name="phone" class="narrow" disabled value="">
            <div class="error"><?php if (isset($errors["phone"])) echo $errors["phone"]; ?></div>

            <label for="email" class="label">Email</label>
            <input id="email" type="email" name="email" class="wide" disabled value="">
            <div class="error"><?php if (isset($errors["email"])) echo $errors["email"]; ?></div>

            <label for="dob" class="label">Date of birth</label>
            <input id="dob" type="date" name="dob" class="narrow" disabled value="">
            <div class="error"><?php if (isset($errors["dob"])) echo $errors["dob"]; ?></div>

            <label for="centre" class="label">Medical centre</label>
            <div class="wide">
                <select name="centre" id="" disabled>
                    <?php
                     
                     foreach($centres as $centre){
                      echo $centre['id'];

                      echo"<option value=".$centre['id']."'";
                      if (isset($data["centre"]) && $date["centre"] ==['id']) echo "selected";
                      
                      echo ">";
                      echo $centre['title'];
                      echo "</option>";
                     }
                    // <!-- <option value="Talbot St Medical Centre">
                    //     Talbot St Medical Centre
                    // </option>
                    // <option value="Highfield Alzheimer’s Care Centre">
                    //     Highfield Alzheimer’s Care Centre
                    // </option>
                    // <option value="Swords Health Center">
                    //     Swords Health Center
                    // </option>
                    // <option value="Greystones Medical Centre">
                    //     Greystones Medical Centre
                    // </option>
                    // <option value="Bray Medical Centre">
                    //     Bray Medical Centre
                    // </option>
                    // <option value="Merrion Fertility Clinic">
                    //     Merrion Fertility Clinic
                    // </option> -->
                    ?>
                </select>
            </div>
            <div class="error"><?php if (isset($errors["centre"])) echo $errors["centre"]; ?></div>
            <label for="insurance" class="label">Insurance</label>
            <div class="wide">
                <input id="insure-none" type="radio" name="insurance" value="None" disabled
                <?php if (isset($data["insurance"]) && $data["insurance"] == "None") echo "checked";  ?>
                >
                <label for="insure-none">None</label>
                <input id="insure-vhi" type="radio" name="insurance" value="VHI" disabled
                <?php if (isset($data["insurance"]) && $data["insurance"] == "VHI") echo "checked";  ?>
                >
                <label for="insure-vhi">VHI</label>
                <input id="insure-laya" type="radio" name="insurance" value="Laya" disabled
                <?php if (isset($data["insurance"]) && $data["insurance"] == "Laya") echo "checked";  ?>
                >
                <label for="insure-laya">Laya</label>
                <input id="insure-irish-life" type="radio" name="insurance" value="Irish Life" disabled
                <?php if (isset($data["insurance"]) && $data["insurance"] == "Irish Life") echo "checked";  ?>
                >
                <label for="insure-irish-life">Irish Life</label>
            </div>
            <div class="error"><?php if (isset($errors["insurance"])) echo $errors["insurance"]; ?></div>
            <label for="preferences" class="label">Communication preferences</label>
            <div class="wide">
                <input id="pref-email" type="checkbox" name="preferences[]" value="Email" disabled
                   <?php if (isset($data["preferences"]) && in_array("Email", $data["preferences"])) echo $errors["preferences"];; ?>
                >
                <label for="pref-email">Email</label>
                <input id="pref-phone" type="checkbox" name="preferences[]" value="Phone" disabled
                <?php if (isset($data["preferences"]) && in_array("Phone", $data["preferences"])) echo $errors["preferences"];; ?>
                >
                <label for="pref-phone">Phone</label>
                <input id="pref-post" type="checkbox" name="preferences[]" value="Post" disabled
                <?php if (isset($data["preferences"]) && in_array("Post", $data["preferences"])) echo $errors["preferences"]; ?>
                >
                <label for="pref-post">Post</label>
            </div>
            <div class="error"><?php if (isset($errors["preferences"]) && in_array("Post", $errors["preferences"])) echo $errors["preferences"]; ?></div>
            <div class="buttons">
                <button class="button primary" type="submit" formaction="patient_delete.php">Delete</button>
                <a class="button light" href="patient_view_all.php">Cancel</a>
            </div>
        </form>
    </main>

    <footer class="footer">
        <p>&copy; 2022, all rights reserved.</p>
    </footer>
</body>
</html>