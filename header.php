<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--    CSS Link-->
    <link rel="stylesheet" type="text/css" href="styles/styles.css"/>
    <link rel="stylesheet" type="text/css" href="styles/reusable-styles.css"/>

    <!--    Font Link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
          rel="stylesheet">
    <style> @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap');
    </style>

    <!--    Font Awesome Link-->
    <script src="https://kit.fontawesome.com/28a4c733b5.js" crossorigin="anonymous"></script>
    <title>The Music Manager</title>

    <!--    Javascript-->
    <script src="scripts/app.js"></script>

    <!--    jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!--    Favicon-->
    <link rel="icon" href="http://localhost/themusicmanager/site-logo.ico">

    <!--    Howler JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.2.3/howler.min.js" integrity="sha512-6+YN/9o9BWrk6wSfGxQGpt3EUK6XeHi6yeHV+TYD2GR0Sj/cggRpXr1BrAQf0as6XslxomMUxXp2vIl+fv0QRA==" crossorigin="anonymous"
            referrerpolicy="no-referrer"></script>
</head>
<body>
<header class="mm-header">
    <div class="mm-header-container mm-flex-space-between mm-flex-align-items-center">
        <div><a href="index.php"><img src="img/site-logo.png" alt=""></a></div>
        <div>
            <ul class="mm-flex mm-menu">
                <li><a href="#">About us</a></li>
                <li><a href="#">Contact</a></li>
				<?php
				if ( isset( $_SESSION["musicmanager_userid"] ) ) {
					echo "<li><a href='profile.php'>My music</a></li>";
					echo "<li><a class='mm-button' href='logout.php'>Logout</a></li>";
				} else {
					echo "<li><a href='signup.php'>Sign Up</a></li>";
					echo "<li><a class='mm-button' href='login.php'>Login</a></li>";
				}
				?>
            </ul>
        </div>
    </div>
</header>
