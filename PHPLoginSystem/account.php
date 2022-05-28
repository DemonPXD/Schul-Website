<!DOCTYPE html>
<html lang="de">
  <head>
      <!--Hoomeeeee-------->
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title>Fitness und Ernährung</title>

  </head>
  <body>
    <?php
    if(isset($_POST["submit"])){
      require("mysql.php");
      $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); //Username überprüfen
      $stmt->bindParam(":user", $_POST["username"]);
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count == 0){
        //Username ist frei
        if($_POST["pw"] == $_POST["pw2"]){
          //User anlegen
          $stmt = $mysql->prepare("INSERT INTO accounts (USERNAME, PASSWORD) VALUES (:user, :pw)");
          $stmt->bindParam(":user", $_POST["username"]);
          $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
          $stmt->bindParam(":pw", $hash);
          $stmt->execute();
          echo "Dein Account wurde angelegt";
        } else {
          echo "Die Passwörter stimmen nicht überein";
        }
      } else {
        echo "Der Username ist bereits vergeben";
      }
    }
     ?>
    <header>
      <img class="logo" src="logo.png" alt="logo" >

      <nav>
        <ul class="nav_links">
          <li class="hoverHome"><a href="home.html">HOME</a>  </li>
          <li class="hoverKontakt"><a href="Kontakt.html">KONTAKT</a></li>
          <li class="hoverImpressum"><a href="about.html">ABOUT ME</a></li>
          <li class="hoverAccount"><a href="PHPLoginSystem\account.php">ACCOUNT</a></li>
        </ul>
      </nav>

    <a class="cta" href=""><button>abbonieren</button></a>
    </header>

<div class="box">

    <h1 id="header1">DAVIDSFITNESSBLOG</h1>
    <h1 id="header2">FITNESS | REZEPTE | WORKOUTS</h1>
    <h1>Account erstellen</h1>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Name" required><br>
        <input type="password" name="pw" placeholder="Passwort" required><br>
        <input type="password" name="pw2" placeholder="Passwort wiederholen" required><br>
        <button type="submit" name="submit">Erstellen</button>
      </form>
      <br>
      <a href="index.php">Hast du bereits einen Account?></a>
</div>


  </body>
</html>
