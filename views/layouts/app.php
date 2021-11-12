<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <link href="<?= URL . '/public/assets/css/styleconnect.css' ?>" rel="stylesheet">
    <link href="<?= URL . '/public/assets/css/bootstrap.min.css' ?>" rel="stylesheet">

    <style>
        h4 {
            color: blue;
            backgroud: red;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- ================Navigation Bar ============ -->
    <div class="container" style="margin-bottom: 80px;">
        <nav class="navbar navbar-expand-lg m-2 fixed-top navbar-light bg-dark shadow-lg">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <h3 class="text-white">e-commerce</h3>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    </ul>

                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active fw-bold text-white" href="<?= URL . '/home' ?>">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fw-bold text-white" href="<?= URL . '/home/incription' ?>">Chariot
                                <span class="badge bg-secondary">
                                    <?php
                                    if (isset($_SESSION['chariot']) && !empty($_SESSION['chariot'][0])) {
                                        echo count($_SESSION['chariot']);
                                    } else {
                                        echo 0;
                                    }
                                    ?>
                                </span>
                            </a>
                        </li>

                        <!-- 
                        -->
                        <?php
                        if (isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {

                        ?>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= $_SESSION['user']['nom'] ?>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="">Logout</a></li>
                                </ul>
                            </li>
                            <?php
                            if ($_SESSION['user']['type_pers'] == 'Prestataire') {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link active fw-bold text-white" href="<?= URL . '/home' ?>">Ajouter un Produit</a>
                                </li>
                            <?php
                            }
                        } else {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-white" href="<?= URL . '/home/login' ?>">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-white" href="<?= URL . '/home/inscription' ?>">Inscription</a>
                            </li>
                        <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!-- ========== end =========-->

    <!-- Display flash message -->
    <div class="container">
        <?php
        if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {

            echo '<div class="container alert alert-danger text-center" style = "margin-bottom: 5px; margin-top: 30px;" ><h3> ' . $_SESSION['message'] . '</h3> </div>';
            unset($_SESSION['message']);
        }
        ?>
    </div>
    <!-- ============ Body content start ============= -->
    <?php
    echo $content
    ?>
    <! /--============end Body content start=============-->


        <script src="<?= URL . '/public/assets/js/bootstrap.bundle.min.js' ?>"></script>
</body>

</html>