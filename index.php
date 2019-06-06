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

</head>
<body class="bg-light" style="height: 100vh">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">ARBA</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarOperations" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Opérations
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarOperations">
                    <a class="dropdown-item" href="#">Annuelle</a>
                    <a class="dropdown-item" href="#">Dernier Semèstre</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarMembres" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Membres
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarMembres">
                    <a class="dropdown-item" href="#">Groupés</a>
                    <a class="dropdown-item" href="#">Individuel</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarOperations" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Consultations
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarOperations">
                    <a class="dropdown-item" href="#">Opérations</a>
                    <a class="dropdown-item" href="#">Membres</a>
                    <a class="dropdown-item" href="#">Impayés</a>
                </div>
            </li>
        </ul>
        <span class="navbar-text">
            <?php echo $date;?>
        </span>
    </div>
</nav>

<div class="container-fluid">

    <div id="content">
        <?php include $page; ?>
    </div>
    <button type="button" class="btn btn-outline-primary" id="goTop" title="Retour en haut" onclick="topFunction()">
        <i class="fas fa-arrow-up fa-2x faa-vertical animated"></i>
    </button>
</div>

<script src="addons/bootstrap/jquery-3.3.1.min.js"></script>
<script src="addons/bootstrap/popper-1.14.3.min.js"></script>
<script src="addons/bootstrap/js/bootstrap.js"></script>

<!-- Custom js file -->
<script src="js/main.js"></script>
<script src="addons/awesomplete/awesomplete.js"></script>
</body>
</html>