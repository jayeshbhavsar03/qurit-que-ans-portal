<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qurit | Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles/accueil.css?v=<?php echo time();?>">
    <link rel="stylesheet" type="text/css" href="styles/navbarStyle.css?v=<?php echo time();?>">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
</head>

<body>
    <?php

      //Vérification si l'utilisateur est connecté
      session_start();
      if (!isset($_SESSION["pseudo"])) {
         header("Location: connexion.php");
         exit();
      }

      require("DB/connexion.php");


      //Fonctions de récuperation des données de la bdd
      function getCateg($id) {
         $co = connexionBdd();
         $query = $co->prepare("SELECT nom FROM categories WHERE id=:id");
         $query->bindParam(":id", $id);
         $query->execute();
         $result = $query->fetch();
         return $result["nom"];
      }

      function getAuteur($id) {
         $co = connexionBdd();
         $query = $co->prepare("SELECT pseudo FROM utilisateurs WHERE id=:id");
         $query->bindParam(":id", $id);
         $query->execute();
         $result = $query->fetch();
         return $result["pseudo"];
      }

      function getAvatar($id) {
         $co = connexionBdd();
         $query = $co->prepare("SELECT avatar FROM utilisateurs WHERE id=:id");
         $query->bindParam(":id", $id);
         $query->execute();
         $result = $query->fetch();
         return $result["avatar"];
      }

      //Changement de l'icone de like
      function changeLikeIcon($like_question_id) {
         $co = connexionBdd();
         $query = $co->prepare("SELECT * FROM likes WHERE utilisateur_id=:pseudo_id AND question_id=:question_id");
         $query->bindParam(":question_id", $like_question_id);
         $query->bindParam(":pseudo_id", $_SESSION["pseudo_id"]);
         $query->execute();
         $row = $query->rowCount();
         if ($row == 1) {
            return "fas fa-heart";
         } else {
            return "far fa-heart";
         }
      }


      ?>

    <!-- NAVBAR -->
    <?php include("lqnavbar.php"); ?>
    <section>
        <div class="container">
            <h3 style="text-align: center; margin-bottom: 2rem;">welcome <?php echo $_SESSION["pseudo"]; ?> on Qurit!</h3>
            <?php

            //affichage de toutes les questions
            $co = connexionBdd();
            $query = $co->query("SELECT * FROM questions");
            $results = $query->fetchAll();
            foreach (array_reverse($results) as $result) {
               $query = $co->prepare("SELECT count(*) from repondre WHERE questions_id=:question_id");
               $query->bindParam(":question_id", $result[0]);
               $query->execute();
               $responseNumber = $query->fetch();
               $query = $co->prepare("SELECT * from likes WHERE question_id=:question_id");
               $query->bindParam(":question_id", $result[0]);
               $query->execute();
               $likesNumber = $query->rowCount();
               $likeIcon = changeLikeIcon($result[0]);
               echo "<div class='toast show' role='alert' aria-live='assertive' aria-atomic='true'>",
                    "<div class='toast-header'>",
                    "<strong class='mr-auto'><img class='avatar' src='" . getAvatar($result[3]) . "'> <a href='profil.php?pseudo_id=$result[3]' style='color:#000;'>" . getAuteur($result[3]) . "</a> | $responseNumber[0] reply | " . getCateg($result[2]) . " | <a href='like.php?question_id=$result[0]'><i class='$likeIcon' style='color:red;'></i></a> $likesNumber</strong>
                    <small>$result[4]</small>",
                    "</div>",
                    "<div class='toast-body'>",
                    "<a href='question.php?question_id=$result[0]' style='color:#000;'>$result[1]</a>",
                    "</div>",
                    "</div>";
            }

            ?>

        </div>
    </section>
    <?php
         require("footer2.php");
         ?>
</body>

</html>