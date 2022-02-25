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
            <a href="patient_view_all.php" class="nav-item active">Patients</a>
            <a href="contact_us.php" class="nav-item">Contact</a>
            <a href="about_us.php" class="nav-item">About</a>
        </div>
    </nav>

    <main class="main">
        <form method="post">
            <h1 class="mt-1 mb-1">List of patients</h1>
                
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="radio" name="patient_id" id="1"></td>
                        <td>
                            <a href="patient_view.php">Alan McFadden</a>
                        </td>
                        <td>38 Liam McGearailt Pl, Duntahane Rd Fermoy Co Cork</td>
                        <td>(025) 340776</td>
                        <td>alan18550@boranora.com</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="patient_id" id="2"></td>
                        <td>
                            <a href="patient_view.php">Sanjay Charles</a>
                        </td>
                        <td>The Old Road Stud Tullow Co Waterford</td>
                        <td>(058) 656344</td>
                        <td>sanjay.charles@nevadaibm.com</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="patient_id" id="3"></td>
                        <td>
                            <a href="patient_view.php">Victoria Keith</a>
                        </td>
                        <td>Main Street Urlingford Co Kilkenny</td>
                        <td>(0504) 21734</td>
                        <td>vivky@tednbe.com</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="patient_id" id="4"></td>
                        <td>
                            <a href="patient_view.php">Sama Wells</a>
                        </td>
                        <td>14 Lower Main St Buncrana Co Donegal</td>
                        <td>(090) 650758</td>
                        <td>sama39@tigo.tk</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="patient_id" id="5"></td>
                        <td>
                            <a href="patient_view.php">Arham Mata</a>
                        </td>
                        <td>3 Ballysimon Road Limerick</td>
                        <td>(061) 418133</td>
                        <td>arham.mata@ermtia.com</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="patient_id" id="6"></td>
                        <td>
                            <a href="patient_view.php">Nyla Bateman</a>
                        </td>
                        <td>Windmill Park Saintfield Co Down</td>
                        <td>(048) 97511402</td>
                        <td>nyla@cuenmex.com</td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-1 buttons">
                <button class="button warning" type="submit" formaction="patient_update_form.php">Update</button> or
                <button class="button danger" type="submit" formaction="patient_delete_form.php">Delete</button> selected patient or
                <a class="button primary" href="patient_create_form.php">Create</a> new patient.
            </div>
        </form>
    </main>

    <footer class="footer">
        <p>&copy; 2022, all rights reserved.</p>
    </footer>
</body>
</html>