<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Qurit | Login</title>
      <link rel="stylesheet" type="text/css" href="styles/connexionStyle.css?v=<?php echo time();?>">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="script.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
   </head>
   <body>
      <?php
      require("DB/connexion.php");
      session_start();
      $co = connexionBdd();
      $message = "";

      //Connexion de l'utilisateur si le pseudo et le mot de passe est bon
      if (isset($_POST["submit"])) {
         $pseudo = $_POST["pseudo"];
         $password = hash('sha256', $_POST["password"]);

         $query = $co->prepare("SELECT * FROM utilisateurs WHERE pseudo=:pseudo and mot_de_passe=:password");
         $query->bindParam(":pseudo", $pseudo);
         $query->bindParam(":password", $password);
         $query->execute();
         $result = $query->fetchAll();
         $rows = $query->rowCount();
         if ($rows == 1) {
               $_SESSION["pseudo"] = $pseudo;
               $_SESSION["pseudo_id"] = $result[0]["id"];
               $_SESSION["pseudo_role"] = $result[0]["role"];
               $_SESSION["pseudo_email"] = $result[0]["email"];
               $_SESSION["pseudo_avatar"] = $result[0]["avatar"];
               header("Location: admin.php");
         } else {
               $message = "User Name or Password is incorrect";
         }
      }



      ?>
      <div class="wrapper">
         <div class="loginBox">
            <h1>LOGIN</h1>
            <h3><?php echo $message; ?></h3>
            <form action="" method="post">
               <p>User Id</p>
               <input type="text" name="pseudo" placeholder="Enter your user id">
               <p>Password</p>
               <input type="password" name="password" placeholder="Enter password">
               <input type="submit" name="submit" value="LOGIN">
               <p style="text-align:center;"><span class="lienExterne">you did't have account? <a href="inscription.php">Register!</span></a>
               </p>
            </form>
         </div>
      </div>
   </body>
</html>