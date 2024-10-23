<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
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
    ini_set('display_errors', 'on');
    $servername = "localhost";
    $username = "root";
    $password = "test";
    $dbname = "tet";
    $minlength = 3;

    if(isset($_GET['search'])){
        $search = $_GET['search'];
        echo('<br>');
        if(strlen($search)<$minlength){
            die('<div class="warning"><strong>Bitte mindestens drei Zeichen eingeben</div>');
        }

        $connection = new mysqli($servername, $username, $password, $dbname);
        if($connection->connect_error){
            die('<div class="alert"><strong>Fehler!</strong> Verbindung zur Datenbank fehlgeschlagen</div>');
        }
        $query = mysqli_query($connection, 'SELECT * FROM products WHERE title LIKE "'.$search.'" LIMIT 30 VALUES') or die ('<br><br><div class="alert"><strong>Fehler!</strong> Suche abgebrochen</div>');

        echo('<div class="content"><h2>Suchergebnis für &#34;'.$search.'&#34;:</h2>');

        echo('<div class="row">');

        while ($row = mysqli_fetch_array($query)) {
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];

            echo('<div class="column"><div class="card">
            <img src="" style="width:100%">
            <h3>'.$title.'</h3>
            <p class="cardprice">'.$price.'€</p>
            <a href="product.php?id='.$id.'"><p><button>Details</button></p></a>
            </div></div>');
        }


        $connection->close();
    } else {
        echo('<br><div class="infocontainer"><div class="infoimage"><img src="logo.png"></div><div class="infotext"><h2>The Enchanting Table</h2><h3>Ein deutscher Marktplatz für alles und jeden.</h3></div></div><br>');
    }
?>
</body>
</html>
