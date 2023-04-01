<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LiveQuestion</title>
    <link rel="stylesheet" type="text/css" href="styles/question.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <style>
    .toast {
        max-width: 100%;
        max-height: 7rem;
        width: 40%;
    }

    .toast.show {
        margin-top: 2% !important;
    }
    .toast{
      width: 50%;
    margin: auto;
    }
    h3{
      text-align: center;
    padding-top: 2rem;
    }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <?php
      session_start();
      include("lqnavbar.php");
      ?>
    <section>
        <div class="container">
            <?php
         if (!isset($_SESSION["pseudo"], $_GET["question_id"])) {
            header("Location: connexion.php");
            exit();
         }

         require("DB/connexion.php");
         $message = "";


         function getAuteur($id) {
            $co = connexionBdd();
            $query = $co->prepare("SELECT pseudo FROM utilisateurs WHERE id=:id");
            $query->bindParam(":id", $id);
            $query->execute();
            $result = $query->fetch();
            return $result["pseudo"];
         }

         function getCateg($id) {
            $co = connexionBdd();
            $query = $co->prepare("SELECT nom FROM categories WHERE id=:id");
            $query->bindParam(":id", $id);
            $query->execute();
            $result = $query->fetch();
            return $result["nom"];
         }

         function getAvatar($id) {
            $co = connexionBdd();
            $query = $co->prepare("SELECT avatar FROM utilisateurs WHERE id=:id");
            $query->bindParam(":id", $id);
            $query->execute();
            $result = $query->fetch();
            return $result["avatar"];
         }


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


         //Affichage de la question
         $co = connexionBdd();

         $query = $co->prepare("SELECT * FROM questions WHERE id=:id");
         $query->bindParam(":id", $_GET["question_id"]);
         $query->execute();
         $result = $query->fetch();
         $query = $co->prepare("SELECT count(*) from repondre WHERE questions_id=:question_id");
         $query->bindParam(":question_id", $result[0]);
         $query->execute();
         $responseNumber = $query->fetch();
         $query = $co->prepare("SELECT * from likes WHERE question_id=:question_id");
         $query->bindParam(":question_id", $result[0]);
         $query->execute();
         $likesNumber = $query->rowCount();
         $likeIcon = changeLikeIcon($result[0]);
         echo "<div class='toast show' role='alert' aria-live='assertive' style='width:100%;' aria-atomic='true' >",
         "<div class='toast-header' style='width: 100%;'>",
         "<strong class='mr-auto'><img class='avatar' src='" . getAvatar($result[3]) . "'> <a href='profil.php?pseudo_id=$result[3]' style='color:#000;'>" . getAuteur($result[3]) . "</a> | $responseNumber[0] reply | " . getCateg($result[2]) . " | <a href='like.php?question_id=$result[0]'><i class='$likeIcon' style='color:red;'></i></a> $likesNumber</strong>
         <small>$result[4]</small>",
         "</div>",
         "<div class='toast-body'>",
         "<a href='question.php?question_id=$result[0]' style='color:#000;'>$result[1]</a>",
         "</div>",
         "</div>";
         ?>
            <div class="row" style="    flex-direction: column;">
                <h3 style=" margin: 0rem 1rem;">Answer :</h3>
                <?php
                  //Affichage des réponses
                  $query = $co->prepare("SELECT * FROM repondre WHERE questions_id=:id");
                  $query->bindParam(":id", $_GET["question_id"]);
                  $query->execute();
                  $results = $query->fetchAll();
                  foreach (array_reverse($results) as $result) {
                      echo "<div class='toast toast1 show' role='alert' aria-live='assertive' aria-atomic='true'>",
                           "<div class='toast-header'>",
                           "<strong class='mr-auto'><img class='avatar' src='" . getAvatar($result[0]) . "'> <a href='profil.php?pseudo_id=$result[0]'>" . getAuteur($result[0]) . "</a></strong>",
                           "<small>$result[2]</small>",
                           "</div>",
                           "<div class='toast-body'>",
                           "$result[3]",
                           "</div>",
                           "</div>";
                  }
                  ?>
                <?php
               //Enregistrement de la réponse
               if (isset($_POST["submit"])) {
                  $reponse = $_POST["reponse"];
                  date_default_timezone_set('UTC');
                  $date = date('Y-m-d H:i:s');

                  $query = $co->prepare("INSERT INTO repondre (utilisateurs_id, questions_id, date, reponse) VALUES (:pseudo_id, :question_id, :date, :reponse)");
                  $query->bindParam(":reponse", $reponse);
                  $query->bindParam(":date", $date);
                  $query->bindParam(":pseudo_id", $_SESSION["pseudo_id"]);
                  $query->bindParam(":question_id", $_GET["question_id"]);
                  try {
                     $query->execute();
                     if ($query) {
                        $message = "response not send!";
                    }
                  } catch (Exception $e) {
                     $message = "response has been send!";
                  }
               }
               ?>


                <!-- FORMULAIRE -->
                <div class="">
                    <h3>Respond to the question :</h3>
                    <div class="row" style="    width: 50%;margin: auto;">
                        <form action="" method="post" style="width: 100%; margin-left: 1rem;">
                            <label for="reponse">Your answer :</label><br>
                            <textarea id="reponse" class="form-control" row="20"
                                style="height: 6rem; border: 2px solid black;" name="reponse"></textarea>
                            <br>
                            <input type="submit" name="submit" class="rosebutton">
                        </form>
                        <p><?php echo $message; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>