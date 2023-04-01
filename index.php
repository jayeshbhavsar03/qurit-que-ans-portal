<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qurit</title>
    <link rel="stylesheet" type="text/css" href="styles/indexStyle.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <script type="text/javascript" src="script/indexScript.js"></script>
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
</head>

<body>
    <header>
        <?php
            require("navbar.php");
            ?>
        <div class="container headerBlock">
            <div class="figureAccueil">
                <div class="figureAccueil2"></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h1>Qurit is a place to gain and share knowledge.</h1>
                    <p>It's a platform to ask questions and connect with people who contribute unique insights and
                        quality answers.</p>
                    <a href="redirection.php" class="btn bouton headerBouton"><span class="headButton">LogIn</span></a>
                </div>
                <div class="col-md-6">
                    <img src="img/main.svg">
                </div>
            </div>
        </div>
    </header>
    <div class="borderBottomHeader"></div>
    <section id="section1">
        <div class="container">
            <div class="row">
                <div class="col-md-4" style="text-align: center;">
                    <img src="./img/ic1.png">
                    <h5>Post the questions</h5>
                    <p>Post the question eazly<br> only you wan't to sign up.</p>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <img src="img/ico2.png">
                    <h5>Asnwer the questions</h5>
                    <p>Answer the posted questions <br> if you konw the answer.</p>
                </div>
                <div class="col-md-4" style="text-align: center;">
                    <img src="img/ic3.png">
                    <h5>Find your quries eazly</h5>
                    <p>Find your quries in few seconds<br> only you wan't to sign up.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="Section3">
        <div class="embed-responsive video_player embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="img/main_v.mp4"></iframe>
        </div>
    </section>
    <section id="Section4">
        <div class="contenuApp">
            <div class="texteApp">
                <h4>About Us</span></h4>
                <br>
                <p>Qurit: student query portal is a platform where student post the query as a question and other
                    users give the answer easily. It is help to student in many type of query like theoretical, coding,
                    mathematics, etc.
                    <br>
                    This is a introduction to new era. This website is a thought of bringing a give new choice to
                    student solve their queries in this new digital generation.
                </p>
            </div>
        </div>
    </section>
    <div class="borderBottomSection4"></div>
    <?php
         require("footer.php");
         ?>
</body>

</html>