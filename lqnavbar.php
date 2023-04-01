<link rel="stylesheet" type="text/css" href="styles/navbarStyle.css?v=<?php echo time();?>">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <img src="img/logo.png" class="logo-img" alt="Logo">
    <a class="navbar-brand" href="index.php" style="color:#000;">Qurit</a>
    <div class="collapse navbar-collapse" id="navbarColor">
        <ul class="navbar-nav login-btn" style="align-items: center;">
            <li class="nav-item">
                <a class="nav-link nav-anc" href="accueil.php" style="color:#000; font-weight: 500;">Questions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="nouvellequestion.php" style="color:#000; font-weight: 500;">Post question</a>
            </li>
            <li>
            <?php
               if ($_SESSION["pseudo_role"] == "admin") {
                  echo " <a class='nav-link' href='admin.php' style='color:#000; font-weight: 500;'>Delete Question</a>";
               }
               ?>
            </li>
        </ul>
        <ul class="navbar-nav login-btn">
        <li class="nav-item dropdown" style="margin-left: 7rem;">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanses="false" style="color:#000; font-weight: 500;"><i class='fas fa-user-alt'></i></a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="profil.php" style="color:#000; font-weight: 500;">View Profile</a>
                    <a class="dropdown-item" href="logout.php" style="color:#000; font-weight: 500;">Log Out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>