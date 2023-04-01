<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Qurit | Sing In</title>
      <link rel="stylesheet" type="text/css" href="styles/inscriptionStyle.css?v=<?php echo time();?>">
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

      //Regular Expression pour les caractères spéciaux
      function has_special_chars($string) {
         return preg_match('/[^a-zA-Z\d]/', $string);
      }

      //Fonction de vérification du mot de passe
      function passwordVerification($pass) {
         if (strlen($pass) >= 8 && has_special_chars($pass) > 0) {
            return true;
         } else {
            return false;
         }
      }

      //Fonctions de vérification si le pseudo et l'email sont uniques
      function userExist($user) {
         $co = connexionBdd();
         $query = $co->prepare("SELECT * FROM utilisateurs WHERE pseudo=:pseudo");
         $query->bindParam(":pseudo", $user);
         $query->execute();
         $row = $query->rowCount();
         if ($row > 0) {
            return true;
         } else {
            return false;
         }
      }

      function emailExist($mail) {
         $co = connexionBdd();
         $query = $co->prepare("SELECT * FROM utilisateurs WHERE email=:email");
         $query->bindParam(":email", $mail);
         $query->execute();
         $row = $query->rowCount();
         if ($row > 0) {
            return true;
         } else {
            return false;
         }
      }

      $message = "";

      //Inscription
      if (isset($_POST["submit"])) {
         if (isset($_POST["pseudo"], $_POST["email"], $_POST["password"], $_POST["passwordverif"], $_POST["genre"])) {
            $pseudo = $_POST["pseudo"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordverif = $_POST["passwordverif"];
            $passwordhash = hash('sha256', $_POST["password"]);
            $genre = $_POST["genre"];
            date_default_timezone_set('Europe/Paris');
            $date = date('Y-m-d H:i:s');
            if ($password == $passwordverif) {
                  if (passwordVerification($password)) {
                     if (userExist($pseudo) == false) {
                        if (emailExist($email) == false) {
                              $co = connexionBdd();
                              $query = $co->prepare("INSERT into utilisateurs (pseudo, email, mot_de_passe, avatar, genre, date_inscription, role) VALUES (:pseudo, :email, :password, 'https://www.tenforums.com/geek/gars/images/2/types/thumb_15951118880user.png', :genre, :date, 'membre')");
                              $query->bindParam(":pseudo", $pseudo);
                              $query->bindParam(":email", $email);
                              $query->bindParam(":password", $passwordhash);
                              $query->bindParam(":genre", $genre);
                              $query->bindParam(":date", $date);
                              $query->execute();
                              if ($query) {
                                 $message = "Your account has been successfully registered";
                              }
                        } else {
                              $message = "The email address is already in use";
                        }
                     } else {
                        $message = "Username is already in use";
                     }
                  } else {
                     $message = "The password must contain 8 characters including 1 special character";
                  }
            } else {
                  $message = "Passwords do not match";
            }
         }
      }

      ?>

      <div class="wrapper">
         <div class="loginBox">
            <h1>Sign In</h1>
            <h3><?php echo $message; ?></h3>
            <form action="" method="post">
               <input type="text" name="pseudo" placeholder="Enter User Name">
               <input type="email" name="email" placeholder="Enter Email Id">
               <p>Genre :</p>
               <div class="radioInput">
                  <label for="Male">Male</label>
                  <input type="radio" style="width: 10%;" name="genre" value="M">
                  <label for="Female">Female</label>
                  <input type="radio" style="width: 10%;" name="genre" value="F">
               </div>
               <input type="password" name="password" placeholder="Enter The Password">
               <input type="password" name="passwordverif" placeholder="Confirm The Password">
               <input type="submit" name="submit" value="Sing In">
               <p class="para">You alrady have account? <a href="connexion.php" >LogIn!</a></p>
            </form>
         </div>
      </div>
</html>