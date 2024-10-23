<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="\style.css">
    <link rel="icon" href="logo.png">
    <title>The Enchanting Table</title>
</head>
<body>
    <div class="topnav">
        <a class="active" href="index.php">Start</a>
        <a href="account.php">Account</a>
        <a href="security.html">Sicherheit</a>
        <form action="index.php" method="GET">
            <input name="search" type="text" placeholder="Suche..">
        </form>
    </div>
<?php
    session_start();
    ini_set('display_errors', 'on');
    $servername = "localhost";
    $username = "root";
    $password = "2t8i0m42005";
    $dbname = "tet";
    $connection = new mysqli($servername, $username, $password, $dbname);
    if($connection->connect_error){
        die('<br><br><div class="alert"><strong>Fehler!</strong> Verbindung zur Datenbank fehlgeschlagen</div>');
    }

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

    } else{
      echo('<br><br><center><h3>Noch keinen Account?</h3><br><p><b><a href="register.php">Registrieren</a></b> oder <b><a href="login.php">Einloggen</a></b></p></center>');
    }
    $connection->close();
?>
</body>
</html>
