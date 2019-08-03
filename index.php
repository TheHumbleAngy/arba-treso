<?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = "accueil";
    }
    $page .= '.php';

    $date = date('l, \l\e j F Y');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TRESO ARBA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="favicon.ico">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="addons/bootstrap/css/bootstrap.css">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="addons/css/all.min.css">
    <link rel="stylesheet" href="addons/css/font-awesome-animation.min.css">

    <!-- Custom style -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/media_styles.css">
    <link rel="stylesheet" href="css/custom_form.css">
    <link rel="stylesheet" href="addons/awesomplete/awesomplete.css">

    <!--    font-->
    <link href='https://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700' rel='stylesheet' type='text/css'>

    <!-- Chartjs -->
    <script src="addons/node_modules/chart.js/dist/Chart.js"></script>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top" id="myNav" style="/*background-color: #e3f2fd;*/">
    <a class="navbar-brand" href="index.php" title="Accueil">
        <img src="images/logo_arba96x30.png" alt="ARBA" class="img-fluid">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=operations/entrees/adhesions/form_adhesions" id="navbarAdhesions" role="button" aria-haspopup="true" aria-expanded="false">
                    Adhésions
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarOperations" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Opérations
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarOperations">
                    <a class="dropdown-item" href="index.php?page=operations/entrees/cotisations/form_cotisations">Cotisations</a>
                    <a class="dropdown-item" href="#">Dépenses</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarConsultations" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Consultations
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarOperations">
                    <a class="dropdown-item" href="index.php?page=operations/entrees/cotisations/liste_cotisations">Cotisations</a>
                    <a class="dropdown-item" href="">Dépenses</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?page=membres/liste_membres">Membres</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarReporting" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Recherche
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarOperations">
                    <a class="dropdown-item" href="index.php?page=">Cotisations</a>
                    <a class="dropdown-item" href="index.php?page=">Dépenses</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="index.php?page=">Membres</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" id="navbarStats" role="button" aria-haspopup="true" aria-expanded="false">
                    Statistiques
                </a>
            </li>
        </ul>
        <span class="navbar-text">
            <?php echo $date;?>
        </span>
    </div>
</nav>

<div class="container-fluid" style="height: 90%">

    <div id="content">
        <?php include $page; ?>
    </div>
    <button type="button" class="btn btn-outline-primary" id="goTop" title="Retour en haut" onclick="topFunction()">
        <i class="fas fa-arrow-up fa-2x faa-vertical animated"></i>
    </button>
</div>

<script type="text/javascript" src="addons/bootstrap/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="addons/bootstrap/popper-1.14.3.min.js"></script>
<script type="text/javascript" src="addons/bootstrap/js/bootstrap.js"></script>

<!-- Custom js file -->
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="addons/awesomplete/awesomplete.js"></script>
</body>
</html>