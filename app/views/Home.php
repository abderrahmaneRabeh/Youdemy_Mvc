<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>YouDemy - Accueil</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="/assets/img/ycd.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>+212679997258</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>rabehlife144@gmail.com</small>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-white px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-white pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="./index.php?page=home" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>YouDemy</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="./index.php?page=home" class="nav-item nav-link active">Accueil</a>
                    <a href="./pages/courses.php" class="nav-item nav-link">Cours</a>
                    <a href="./pages/ListCategory.php" class="nav-item nav-link">Categories</a>
                </div>
                <?php if (isset($_SESSION['utilisateur'])): ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle"
                            style="text-decoration: none;color: black;font-weight: bold;border-radius: 5px;padding: 5px 10px;background-color: #f5f5f5;"
                            data-toggle="dropdown"><?php echo $_SESSION['utilisateur']['nom']; ?></a>
                        <div class="dropdown-menu m-0" style="border-radius: 5px;">
                            <?php if ($_SESSION['utilisateur']['role'] == 'etudiant'): ?>
                                <a href="./pages/mesCours.php" class="dropdown-item">Mes Cours</a>
                            <?php endif; ?>
                            <a href="./actions/lougout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i></a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="./index.php?url=login" class="btn btn-primary py-2 px-4 d-none d-lg-block">Se connecter</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">

        <!-- afficher un message pour les etudiants banner -->
        <?php if (isset($_SESSION['Banned'])): ?>
            <div class="popup" style="position: fixed; top: 20%; left: 50%; z-index: 1000;">
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['Banned']; ?>
                </div>
            </div>
            <?php unset($_SESSION['Banned']); ?>
        <?php endif; ?>
        <div class="container text-center my-2 py-2">
            <h1 class="text-white mt-4 mb-4">Vous &ecirc;tes &agrave; la bonne place</h1>
            <h1 class="text-white display-4 mb-5">D&eacute;couvrez nos cours d'apprentissage</h1>
            <div class="mx-auto mb-2" style="width: 100%; max-width: 800px;">
                <p class="text-white">Vous cherchez une plateforme de formation en ligne pour am&eacute;liorer vos
                    comp&eacute;tences ? YouDemy est l'endroit id&eacute;al pour vous. Nous offrons des milliers de
                    cours dans des domaines diff&eacute;rents pour vous aider &agrave; atteindre vos objectifs.</p>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-fluid ">
        <div class="container ">
            <div class="row">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="/assets/img/courses-3.jpg"
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">A propos</h6>
                        <h1 class="display-4"><span class="text-primary">YouDemy</span>, votre plateforme de formation
                            en ligne</h1>
                    </div>
                    <p>Nous sommes une plateforme de formation en ligne qui propose des cours et des formations dans
                        diff&eacute;rents domaines. Nous offrons des ressources &eacute;ducatives et des outils pour
                        vous
                        aider &agrave; am&eacute;liorer vos comp&eacute;tences et &agrave; atteindre vos objectifs.
                        Nous sommes votre premier choix pour l'&eacute;ducation en ligne, partout dans le monde.</p>
                    <div class="row pt-3 mx-0">
                        <div class="col-3 px-0">
                            <div class="bg-success text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">123</h1>
                                <h6 class="text-uppercase text-white">Cours <span class="d-block">disponibles</span>
                                </h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-primary text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">1234</h1>
                                <h6 class="text-uppercase text-white">Cours <span class="d-block">en ligne</span></h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-secondary text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">123</h1>
                                <h6 class="text-uppercase text-white">Instructeurs <span
                                        class="d-block">exp&eacute;riment&eacute;s</span></h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-warning text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">1234</h1>
                                <h6 class="text-uppercase text-white">Etudiants <span class="d-block">satisfaits</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Feature Start -->
    <div class="container-fluid bg-image" style="margin: 90px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 my-5 pt-5 pb-lg-5">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Pourquoi
                            choisir nous ?</h6>
                        <h1 class="display-4">Pourquoi commencer &agrave; apprendre avec nous ?</h1>
                    </div>
                    <p class="mb-4 pb-2">Nous sommes YouDemy, une plateforme de formation en ligne qui propose des
                        cours et des formations dans diff&eacute;rents domaines. Nous offrons des ressources
                        &eacute;ducatives et des outils pour vous aider &agrave; am&eacute;liorer vos comp&eacute;tences
                        et &agrave; atteindre vos objectifs.</p>
                    <div class="d-flex mb-3">
                        <div class="btn-icon bg-primary mr-4">
                            <i class="fa fa-2x fa-graduation-cap text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Des instructeurs exp&eacute;riment&eacute;s</h4>
                            <p>Nous avons des instructeurs exp&eacute;riment&eacute;s qui vous aideront &agrave;
                                atteindre vos objectifs.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="btn-icon bg-secondary mr-4">
                            <i class="fa fa-2x fa-certificate text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Des certificats internationaux</h4>
                            <p>Nous offrons des certificats internationaux qui vous aideront &agrave; trouver un
                                emploi.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="btn-icon bg-warning mr-4">
                            <i class="fa fa-2x fa-book-reader text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Des cours en ligne</h4>
                            <p class="m-0">Nous offrons des cours en ligne qui vous permettent d'apprendre &agrave;
                                votre propre rythme.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="/assets/img/courses-2.jpg"
                            style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Start -->
    <!-- Footer Start -->
    <div class="container-fluid position-relative overlay-top bg-dark text-white-50 py-5" style="margin-top: 90px;">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <a href="index.html" class="navbar-brand">
                        <h1 class="mt-n2 text-uppercase text-white"><i class="fa fa-book-reader mr-3"></i>YouDemy
                        </h1>
                    </a>
                    <p class="m-0">YouDemy est une plateforme de formation en ligne qui propose des cours et des
                        formations dans divers domaines. Nous offrons des ressources &eacute;ducatives et des outils
                        pour vous aider &agrave; am&eacute;liorer vos comp&eacute;tences et &agrave; atteindre vos
                        objectifs.</p>
                </div>
                <div class="col-md-6 mb-5">
                    <h3 class="text-white mb-4">Abonnez-vous &agrave; notre newsletter</h3>
                    <div class="w-100">
                        <div class="input-group">
                            <input type="text" class="form-control border-light" style="padding: 30px;"
                                placeholder="Votre adresse e-mail">
                            <div class="input-group-append">
                                <button class="btn btn-primary px-4">Inscrivez-vous</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white-50 border-top py-4"
        style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                    <p class="m-0">Copyright &copy; <a class="text-white" href="#">YouDemy</a>. Tous droits
                        r&eacute;serv&eacute;s.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <p class="m-0">Crée par <a class="text-white" href="https://htmlcodex.com">Abderrahmane
                            Rabeh</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i
            class="fa fa-angle-double-up"></i></a>



    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/lib/easing/easing.min.js"></script>
    <script src="/assets/lib/waypoints/waypoints.min.js"></script>
    <script src="/assets/lib/counterup/counterup.min.js"></script>
    <script src="/assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- Template Javascript -->
    <script src="/assets/js/main.js"></script>
</body>

</html>