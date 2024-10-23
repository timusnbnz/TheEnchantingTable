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
    <div class="content">
      <br><br>
<?php
  session_start();
  ini_set('display_errors', 'on');
  $dbserver = "localhost";
  $dbusername = "root";
  $dbpassword = "2t8i0m42005";
  $dbname = "tet";

  $connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbname);
  if($connection->connect_error){
      die('<div class="alert"><strong>Fehler!</strong> Verbindung zur Datenbank fehlgeschlagen</div>');
  }

  $error = '';

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["username"])){
      $username = $_POST["username"];
    }else{
      $error = '<div class="warning"><strong>Warnung!</strong> Bitte Nutzername eingeben</div>';
    }
    if(isset($_POST["password1"])){
      $password1 = $_POST["password1"];
    }else{
      $error = '<div class="warning"><strong>Warnung!</strong> Bitte Passwort eingeben</div>';
    }
    if(isset($_POST["password2"])){
      $password2 = $_POST["password2"];
    }else{
      $error = '<div class="warning"><strong>Warnung!</strong> Bitte Passwort bestätigen</div>';
    }

    if($error==''){
      $sql = "SELECT id FROM users WHERE username = ?";
      if($stmt = mysqli_prepare($connection, $sql)){
          mysqli_stmt_bind_param($stmt, "s", $param_username);
          $param_username = trim($_POST["username"]);
          if(mysqli_stmt_execute($stmt)){
              mysqli_stmt_store_result($stmt);
              if(mysqli_stmt_num_rows($stmt) == 1){
                  $error = '<div class="warning"><strong>Warnung!</strong> Dieser Nutzername wird bereits verwendet</div>';
              } else{
                  $username = trim($_POST["username"]);
              }
          } else{
              echo '<div class="warning"> Etwas ist fehlgeschlagen.</div>';
          }
          mysqli_stmt_close($stmt);
      }
    }
  }


  if($_SERVER["REQUEST_METHOD"] == "POST"){      }
      if(empty(trim($_POST["password1"]))){
          $password_err = "Please enter a password.";
      } elseif(strlen(trim($_POST["password"])) < 8){
          $password_err = '<div class="warning">Das Passwort muss mindestens 8 Zeichen enthalten</div>';
      } else{
          $password = trim($_POST["password"]);
      }

      if(empty(trim($_POST["password2"]))){
          $confirm_password_err = '<div class="warning">Passwort muss bestätigt werden</div>';
      } else{
          $confirm_password = trim($_POST["confirm_password"]);
          if(empty($password_err) && ($password != $confirm_password)){
              $confirm_password_err = '<div class="warning">Die Passwörter stimmen nicht überein</div>';
          }
      } if(empty($confirm_password_err)){
          $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
          if($stmt = mysqli_prepare($link, $sql)){
              mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
              $param_username = $username;
              $param_password = password_hash($password, PASSWORD_DEFAULT);
              if(mysqli_stmt_execute($stmt)){
                  header("location: login.php");
              } else{
                  echo '<div class="alert"><strong>Fehler!</strong> Verbindung zur Datenbank fehlgeschlagen</div>';
              }
              mysqli_stmt_close($stmt);
          }
      }
      mysqli_close($connection);
  }
?>
<body>
    <div class="wrapper">
      <div class="content">
              <div class="login-page">
                  <div class="loginform">
                      <div class="login">
                          <div class="login-header">
                              <h3>Registrieren</h3>
                              <p>Passwörter können nicht zurückgesetzt werden</p>
                          </div>
                      </div>
                      <form class="login-form" action="register.php" method=POST>
                          <input name="username" type="text" placeholder="Username"/>
                          <input name="password1" type="password" placeholder="Passwort"/>
                          <input name="password2" type="password" placeholder="Passwort Wiederholen"/>
                          <button>Login</button>
                          <p class="message"><a href="login.php">Stattdessen Einloggen</a></p>
                      </form>
                  </div>
              </div>
          </div>
    </div>
</body>
