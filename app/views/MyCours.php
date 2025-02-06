<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>YouDemy - Mes Cours</title>
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
            height: 200px;
        }

        .progress {
            height: 10px;
            margin-top: 10px;
        }

        .course-card {
            transition: transform 0.3s ease;
            margin-bottom: 30px;
        }

        .course-card:hover {
            transform: translateY(-5px);
        }

        .course-status {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            border-radius: 15px;
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .status-completed {
            background-color: #28a745;
        }

        .status-in-progress {
            background-color: #ffc107;
        }

        .status-not-started {
            background-color: #dc3545;
        }

        .course-info {
            padding: 15px;
            background: white;
            border-radius: 0 0 5px 5px;
        }

        .last-accessed {
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark">
        <div class="row py-2 px-lg-5">
            <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center text-white">
                    <small><i class="fa fa-phone-alt mr-2"></i>+212679997258</small>
                    <small class="px-3">|</small>
                    <small><i class="fa fa-envelope mr-2"></i>contact@youdemy.com</small>
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
                    <a href="./index.php?url=home" class="nav-item nav-link">Accueil</a>
                    <a href="./index.php?url=coursesList" class="nav-item nav-link active">Cours</a>
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
        <div class=" container text-center">
            <h1 class="text-white display-4">Mes Cours</h1>
            <div class="d-inline-flex text-white mb-5">
                <p class="m-0 text-uppercase"><a class="text-white" href="">Accueil</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Mes Cours</p>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Courses Start -->
    <div class="container-fluid">
        <div class="container py-5">
            <div class="row mx-0 justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center position-relative mb-5">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Mes
                            apprentissages</h6>
                        <h1 class="display-5">Continuez votre progression</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Course Card Template -->
                <?php if (empty($Mycourses)): ?>
                    <div class="col-md-12 text-center">
                        <h4 class="mb-3 bg-light p-3">Vous n'avez pas encore de cours</h4>
                    </div>
                <?php else: ?>
                    <?php foreach ($Mycourses as $course): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="course-card shadow">
                                <div class="position-relative">
                                    <img class="img-fluid" src="<?= $course['imgPrincipale_cours'] ?>" alt="Course Image">
                                    <?php if ($course['is_video'] == 1): ?>
                                        <div class="course-status status-in-progress">En cours</div>
                                    <?php endif; ?>
                                </div>
                                <div class="course-info">
                                    <a href="./CourseDetails.php?id=<?= $course['id_cour'] ?>" style="text-decoration: none;">
                                        <h4 class="mb-3"><?= $course['titre_cour'] ?></h4>
                                    </a>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 65%;"
                                            aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <span class="last-accessed"><i class="far fa-clock mr-1"></i> Inscrit le:
                                            <?= $course['date_insc'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <!-- Courses End -->

    <!-- Footer Start -->
    <div class="container-fluid position-relative overlay-top bg-dark text-white-50 py-5" style="margin-top: 90px;">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <a href="index.html" class="navbar-brand">
                        <h1 class="mt-n2 text-uppercase text-white"><i class="fa fa-book-reader mr-3"></i>YouDemy</h1>
                    </a>
                    <p class="m-0">YouDemy est une plateforme de formation en ligne qui propose des cours dans divers
                        domaines. Nous offrons des ressources éducatives pour vous aider à améliorer vos compétences.
                    </p>
                </div>
                <div class="col-md-6 mb-5">
                    <h3 class="text-white mb-4">Newsletter</h3>
                    <div class="w-100">
                        <div class="input-group">
                            <input type="text" class="form-control border-light" style="padding: 30px;"
                                placeholder="Votre Email">
                            <div class="input-group-append">
                                <button class="btn btn-primary px-4">S'inscrire</button>
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
                    <p class="m-0">Copyright &copy; <a class="text-white" href="#">YouDemy</a>. Tous droits réservés.
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <p class="m-0">Designed by <a class="text-white" href="#">Your Name</a></p>
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
    <script src="../assets/js/easing/easing.min.js"></script>
    <script src="../assets/js/waypoints/waypoints.min.js"></script>
    <script src="../assets/js/counterup/counterup.min.js"></script>
    <script src="../assets/js/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>
</body>

</html>