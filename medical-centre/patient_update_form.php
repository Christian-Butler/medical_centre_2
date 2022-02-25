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
            <h1 class="heading mb-1">Update existing patient</h1>

            <label for="name" class="label">Name</label>
            <input id="name" type="text" name="name" class="narrow" value="">
            <div class="error"></div>

            <label for="address" class="label">Address</label>
            <input id="address" type="text" name="address" class="wide" value="">
            <div class="error"></div>

            <label for="phone" class="label">Phone</label>
            <input id="phone" type="tel" name="phone" class="narrow" value="">
            <div class="error"></div>

            <label for="email" class="label">Email</label>
            <input id="email" type="email" name="email" class="wide" value="">
            <div class="error"></div>

            <label for="dob" class="label">Date of birth</label>
            <input id="dob" type="date" name="dob" class="narrow" value="">
            <div class="error"></div>

            <label for="centre" class="label">Medical centre</label>
            <div class="wide">
                <select name="centre" id="">
                    <option value="Talbot St Medical Centre">
                        Talbot St Medical Centre
                    </option>
                    <option value="Highfield Alzheimer’s Care Centre">
                        Highfield Alzheimer’s Care Centre
                    </option>
                    <option value="Swords Health Center">
                        Swords Health Center
                    </option>
                    <option value="Greystones Medical Centre">
                        Greystones Medical Centre
                    </option>
                    <option value="Bray Medical Centre">
                        Bray Medical Centre
                    </option>
                    <option value="Merrion Fertility Clinic">
                        Merrion Fertility Clinic
                    </option>
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