<?php
session_start();
if (!isset($_SESSION["pseudo"]) || $_SESSION["pseudo_role"] != "admin") {
    header("Location: connexion.php");
    exit();
}

require("DB/connexion.php");

//Suppression des likes, reponses et de la question selectionner
$co = connexionBdd();

$query = $co->prepare("DELETE FROM likes WHERE question_id=:question_id");
$query->bindParam(":question_id", $_GET["question_id"]);
$query->execute();

$query = $co->prepare("DELETE FROM repondre WHERE questions_id=:question_id");
$query->bindParam(":question_id", $_GET["question_id"]);
$query->execute();


$query = $co->prepare("DELETE FROM questions WHERE id=:question_id");
$query->bindParam(":question_id", $_GET["question_id"]);
$query->execute();
if ($query) {
    header("Location: admin.php");
} else {
    echo "Error";
}

?>