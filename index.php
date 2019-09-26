<?php
    $page = isset($_GET['page']) ? $_GET['page'] : "accueil";
    $page .= '.php';
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
    <link rel="stylesheet" href="addons/awesomplete/awesomplete.css">

    <!--    font-->
    <link href='https://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700' rel='stylesheet' type='text/css'>

    <!-- Chartjs -->
    <script src="addons/node_modules/chart.js/dist/Chart.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light sticky-top" id="myNav">
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
                <a class="nav-link mx-2" href="index.php?page=operations/encaissement/adhesions/form_adhesions"
                   id="navbarAdhesions" role="button" aria-haspopup="true" aria-expanded="false">
                    Adhésions
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-2" href="index.php?page=operations/encaissement/cotisations/form_cotisations"
                   id="navbarCotisations" role="button" aria-haspopup="true" aria-expanded="false">
                    Cotisations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-2" href="index.php?page=operations/param_operation" id="navbarOperations"
                   role="button" aria-haspopup="true" aria-expanded="false">
                    Opérations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-2" href="index.php?page=consultations/param_consultation" id="navbarConsultations"
                   role="button" aria-haspopup="true" aria-expanded="false">
                    Consultations
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-2" href="index.php?page=recherches/param_recherches" id="navbarReporting"
                   role="button" aria-haspopup="true" aria-expanded="false">
                    Recherche
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-2" href="index.php?page=stats/param_stats" id="navbarStats" role="button" aria-haspopup="true"
                   aria-expanded="false">
                    Statistiques
                </a>
            </li>
        </ul>
        <span class="navbar-text" id="curr_date"></span>
    </div>
</nav>

<div id="w_solde_gnl" class="shadow-sm text-primary gradient faa-float animated" onclick="showSolde(state = 0)">
    <span>SG</span>
</div>

<div id="w_solde_coti" class="shadow-sm text-success gradient-in faa-pulse animated d-none" onclick="showSolde(state = 1)">
    <span>SC</span>
</div>

<div id="w_solde_adhe" class="shadow-sm text-danger gradient-out faa-wrench animated d-none" onclick="showSolde(state = 2)">
    <span>SA</span>
</div>

<div id="w_solde_mvt" class="shadow-sm text-warning gradient faa-bounce animated d-none" onclick="showSolde(state = 3)">
    <span>SM</span>
</div>

<!-- Modals -->
<div class="modal fade" id="soldeModal" tabindex="-1" role="dialog" aria-labelledby="soldeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="soldeModalLabel">ARBA ℹ️</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="date_solde" class="ml-auto">
                    <input type="date" id="date_solde" class="form-control form-control-sm" onchange="showSolde(state, this.value)">
                </label>
                <blockquote class="blockquote">
                    <p class="mb-0"></p>
                </blockquote>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-xl-2">
    <?php
        if (isset($page)) {
            include $page;
        }
    ?>

    <button type="button" class="btn btn-outline-primary" id="goTop" title="Retour en haut" onclick="getToTop()">
        <i class="fas fa-arrow-up fa-2x faa-vertical animated"></i>
    </button>
</div>

<script type="text/javascript" src="addons/bootstrap/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="addons/bootstrap/popper-1.14.3.min.js"></script>
<script type="text/javascript" src="addons/bootstrap/js/bootstrap.js"></script>

<!-- Custom js file -->
<script type="text/javascript" src="addons/awesomplete/awesomplete.js"></script>
<script type="text/javascript" src="addons/moment/moment.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script>
    moment.locale('fr');
    setInterval(function () {
        let currentDateTime = moment().format('dddd Do MMMM YYYY, HH:mm');
        document.getElementById('curr_date').textContent = currentDateTime.charAt(0).toUpperCase() + currentDateTime.slice(1);
    });
</script>
</body>
</html>