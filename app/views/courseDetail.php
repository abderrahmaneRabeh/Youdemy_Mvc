<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>YouDemy - Course Details</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="../assets/img/ycd.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../assets/js/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <style>
        .img-fluid {
            background-size: cover;
            object-fit: cover;
        }

        .course-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            background: rgba(29, 36, 52, 0.7);
            padding: 1rem;
            border-radius: 5px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .position-relative:hover .course-overlay {
            opacity: 1;
        }

        .instructor-card {
            transition: transform 0.3s;
        }

        .instructor-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark" id="topPage">
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
                    <a class="text-white px-2" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="text-white px-2" href=""><i class="fab fa-twitter"></i></a>
                    <a class="text-white px-2" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="text-white px-2" href=""><i class="fab fa-instagram"></i></a>
                    <a class="text-white pl-2" href=""><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="../index.php" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>YouDemy</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="./index.php?url=home" class="nav-item nav-link active">Accueil</a>
                    <a href="./index.php?url=coursesList" class="nav-item nav-link">Cours</a>
                    <a href="./index.php?url=categoryList" class="nav-item nav-link">Categories</a>
                </div>
                <?php if (isset($_SESSION['role'])): ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle"
                            style="text-decoration: none;color: black;font-weight: bold;border-radius: 5px;padding: 5px 10px;background-color: #f5f5f5;"
                            data-toggle="dropdown">
                            <?php if (isset($_SESSION['nom'])): ?>
                                <?= $_SESSION['nom']; ?>
                            <?php else: ?>
                                user
                            <?php endif; ?>
                        </a>
                        <div class="dropdown-menu m-0" style="border-radius: 5px;">
                            <?php if ($_SESSION['role'] == 'etudiant'): ?>
                                <a href="./index.php?url=myCourses" class="dropdown-item">Mes Cours</a>
                            <?php endif; ?>
                            <a href="./index.php?url=logout" class="dropdown-item"><i class="fas fa-sign-out-alt"></i></a>
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
    <div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom">
        <div class="container text-center">
            <h1 class="text-white display-4">Détail du cours</h1>
            <div class="d-inline-flex text-white mb-5">
                <p class="m-0 text-uppercase"><a class="text-white" href="">Accueil</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Détail du cours</p>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Course Details Start -->
    <div class="container-fluid">
        <div class="container py-5">
            <div class="row">
                <!-- Main Course Content -->
                <div class="col-lg-8">
                    <div class="mb-5">
                        <!-- Course Title -->
                        <div class="section-title position-relative mb-5">
                            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">ID du cours
                                :
                                #<?= $course->id_cour ?></h6>
                            <h1 class="display-5"><?= $course->titre_cour ?></h1>
                        </div>

                        <!-- Course Images -->
                        <div class="position-relative mb-5">
                            <img class="img-fluid rounded w-100 mb-4" src="<?= $course->imgPrincipale_cours ?>"
                                alt="Image principale du cours" style="height: 500px; object-fit: cover;">
                        </div>

                        <!-- Course Description -->
                        <h2 class="mb-4">Description du cours</h2>
                        <p class="mb-5"><?= $course->description_cours ?></p>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <img style="height: 500px; object-fit: cover;" class="img-fluid rounded w-100"
                                    src="../assets/img/courses-2.jpg" alt="Image du cours 1">
                            </div>

                        </div>

                        <!-- Course Content -->
                        <h2 class="mb-4">Contenu du cours</h2>
                        <div class="accordion" id="courseContent">
                            <div class="card border-0 mb-2">
                                <div class="card-header p-0 border bg-secondary">
                                    <h2 class="mb-0">
                                        <button class="btn btn-block py-3 text-white text-left" type="button"
                                            data-toggle="collapse" data-target="#content1">
                                            <i class="fa fa-file-archive mr-3"></i>Ressources
                                            <span class="float-right"><i class="fa fa-chevron-down"></i></span>
                                        </button>
                                    </h2>
                                </div>
                                <div id="content1" class="collapse show" data-parent="#courseContent">
                                    <div class="card-body bg-light">
                                        <?php if ($course->is_video == 1): ?>
                                            <a href="<?= $course->contenu_cours ?>" target="_blank"
                                                class="d-flex align-items-center text-dark mb-3">
                                                <i class="fa fa-play-circle text-primary mr-3"></i>
                                                <span>Video qui suite le cours</span>
                                                <span class="ml-auto">30 min</span>
                                            </a>
                                        <?php else: ?>
                                            <a href="<?= $course->contenu_cours ?>" target="_blank"
                                                class="d-flex align-items-center text-dark mb-3">
                                                <i class="fa fa-file-pdf text-primary mr-3"></i>
                                                <span>Documentaion du cours</span>
                                                <span class="ml-auto">PDF/WORD</span>
                                            </a>
                                        <?php endif; ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Information Sidebar -->
                <div class="col-lg-4 mt-5 mt-lg-0">
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['error'];
                            unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['success'];
                            unset($_SESSION['success']); ?>
                        </div>
                    <?php endif; ?>
                    <!-- Course Features -->
                    <div class="bg-primary mb-5 py-3">
                        <h3 class="text-white py-3 px-4 m-0">Caractéristiques du cours</h3>
                        <div class="d-flex justify-content-between border-bottom px-4 py-3">
                            <h6 class="text-white my-auto">Catégorie</h6>
                            <h6 class="text-white my-auto"><?= $course->category_id ?></h6>
                        </div>
                        <div class="d-flex justify-content-between border-bottom px-4 py-3">
                            <h6 class="text-white my-auto">Enseignant</h6>
                            <h6 class="text-white my-auto"><?= $course->id_enseignant ?></h6>
                        </div>
                        <div class="d-flex justify-content-between border-bottom px-4 py-3">
                            <h6 class="text-white my-auto">Identifiant du cours</h6>
                            <h6 class="text-white my-auto">#<?= $course->id_cour ?></h6>
                        </div>
                        <div class="py-3 px-4">

                            <?php if ($isInscription): ?>
                                <div class="alert alert-info">
                                    Vous êtes déjà inscrit à ce cours.
                                </div>
                            <?php else: ?>
                                <?php if (isset($_SESSION['utilisateur'])): ?>
                                    <a class="btn btn-block btn-secondary py-3 px-5"
                                        href="../actions/Inscrivez_vous.php?id_cour=<?= $course->id_cour ?>">Inscrivez-vous</a>
                                <?php else: ?>
                                    <a class="btn btn-block btn-secondary py-3 px-5"
                                        href="./seConnecter.php?id_page=<?= $course->id_cour ?>">Se connecter</a>
                                <?php endif; ?>
                            <?php endif; ?>

                        </div>
                    </div>

                    <!-- Instructor Info -->
                    <div class="bg-secondary p-4 mb-5 instructor-card">
                        <h3 class="text-white mb-4">Enseignant du cours</h3>
                        <div class="d-flex align-items-center mb-4">
                            <div class="ml-4">
                                <h4 class="text-white"><?= $course->id_enseignant ?></h4>
                                <p class="m-0 text-white-50">Expert en développement web et enseignement</p>
                            </div>
                        </div>
                        <p class="text-white">Enseignant expert avec plus de 10 ans d'expérience dans le développement
                            web
                            et l'enseignement.</p>
                    </div>
                    <div class="bg-secondary p-4 mb-5">
                        <h3 class="text-white mb-4">Mots-clés</h3>
                        <div class="d-flex flex-wrap">
                            <?php foreach ($courseTags as $tag): ?>
                                <a href="" class="btn btn-sm btn-light m-1"><?= $tag['tag_name'] ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Course Details End -->

    <!-- Footer Start -->
    <div class="container-fluid position-relative overlay-top bg-dark text-white-50 py-5">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <a href="index.html" class="navbar-brand">
                        <h1 class="mt-n2 text-uppercase text-white"><i class="fa fa-book-reader mr-3"></i>YouDemy</h1>
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
                    <p class="m-0">Crée par <a class="text-white" href="https://htmlcodex.com">Abderrahmane Rabeh</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/easing/easing.min.js"></script>
    <script src="../assets/js/waypoints/waypoints.min.js"></script>
    <script src="../assets/js/counterup/counterup.min.js"></script>
    <script src="../assets/js/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>
</body>

</html>