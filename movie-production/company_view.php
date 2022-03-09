<?php
require_once "include/database_connection.php";

try
{
    $params = array(
        'id' => $_GET['id']
    );
    $sql = 'SELECT * FROM company WHERE id = :id';
    $stmt = $connection->prepare($sql);
    $success = $stmt->execute($params);
    if (!$success) {
        throw new Exception("Failed to retrieve patient");
    }
    else {
        $company = $stmt->fetch();
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
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
        <h1 class="mt-1 mb-1"><?= $company["name"] ?></h1>
            
        <table class="table">
            <tbody>
                <tr>
                    <th>Address</th>
                    <td><?= $company["address"] ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?= $company["phone_number"] ?></td>
                </tr>
                <tr>
                    <th>Website</th>
                    <td>
                    <?= $company["website"] ?>
                        <a href="https://www.warped-productions.com/" target="_blank">
                            https://www.warped-productions.com/
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>
                    <?= $company["description"] ?>
                        Aliquam dui metus, efficitur a molestie ac, finibus nec nisl. 
                        Donec sagittis a augue id gravida. Sed hendrerit tempus sapien. 
                        Phasellus nec mi in enim scelerisque cursus et quis diam. 
                        Mauris in gravida nulla. Nunc luctus risus eu nunc finibus 
                        bibendum. Proin porta posuere venenatis. Donec sed finibus 
                        purus, quis tempus nunc.
                    </td>
                </tr>
                <tr>
                    <th>Number of movies</th>
                    <td>
                    <?= $company["number_of_movies"] ?>
                    0-10</td>
                </tr>
                <tr>
                    <th>Total box office</th>
                    <td>
                    <?= $company["total_box_office"] ?>
                    €12,344,743</td>
                </tr>
                <tr>
                    <th>Date founded</th>
                    <td>
                    <?= $company["date_founded"] ?>
                    1970-01-01</td>
                </tr>
            </tbody>
        </table>
    </main>

    <footer class="footer">
        <p>&copy; 2022, all rights reserved.</p>
    </footer>
</body>
</html>