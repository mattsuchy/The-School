<?php
session_start();
require_once 'models/user.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>The Flight School</title>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="topMenu d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom box-shadow">
            <img src="./images/logo.png" class="logo img-fluid">
            <h1 class="my-0 mr-md-auto font-weight-normal">The Flight School</h1>

            <?php
            if (isset($_SESSION['owner']) || isset($_SESSION['manager']) || isset($_SESSION['sales'])) {
                echo ' <nav class="topNav my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="/school">School</a>
                <a class="p-2 text-dark" href="/administration">Administration</a>
            </nav>';
                echo "<div class='welcomUser'>
                
                <div class='wuRight'>";
                if (isset($_SESSION['owner'])) {
                    echo "<img class='welcomUserImg rounded' src=' " . unserialize($_SESSION['owner'])->user_image . "'>";
                    echo "<h4>" . unserialize($_SESSION['owner'])->user_name . "</h4>";
                    echo "<h5>" . unserialize($_SESSION['owner'])->user_role . "</h5>";
                } else if (isset($_SESSION['manager'])) {
                    echo "<img class='welcomUserImg rounded' src=' " . unserialize($_SESSION['manager'])->user_image . "'>";
                    echo "<h4>" . unserialize($_SESSION['manager'])->user_name . "</h4>";
                    echo "<h5>" . unserialize($_SESSION['manager'])->user_role . "</h5>";
                } else {
                    echo "<img class='welcomUserImg rounded' src=' " . unserialize($_SESSION['sales'])->user_image . "'>";
                    echo "<h4>" . unserialize($_SESSION['sales'])->user_name . "</h4>";
                    echo "<h5>" . unserialize($_SESSION['sales'])->user_role . "</h5>";
                }
                echo '<a href="controllers/logout.php">Logout</a>';
                echo "</div>";
            }
            ?>

        </div>
    </div>
    <?php
    $request_uri = explode('/', $_SERVER['REQUEST_URI'], 2);
    switch ($request_uri[1]) {
        // Home page
        case '':
            if (isset($_SESSION['owner']) || isset($_SESSION['manager']) ||
                    isset($_SESSION['sales'])) {
                require './views/school.php';
            } else {
                require './views/login.php';
            }
            break;
        case 'login':
            if (!isset($_SESSION['owner']) && !isset($_SESSION['manager']) &&
                    !isset($_SESSION['sales'])) {
                require './views/login.php';
            } else {
                require './views/school.php';
            }
            break;

        case 'administration':
            if (isset($_SESSION['owner']) || isset($_SESSION['manager'])) {
                require './views/admin.php';
            } else {
                require './views/login.php';
            }
            break;

        case 'school':
            if (isset($_SESSION['owner']) || isset($_SESSION['manager']) ||
                    isset($_SESSION['sales'])) {
                require './views/school.php';
            } else {
                require './views/login.php';
            }


            break;
        // Everything else
        default:

            require './views/error404.php';
            break;
    }
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity = "sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin = "anonymous"></script>
</body>
</html>
