<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>YouDemy - Categories</title>
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
    <link href="/assets/js/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <style>
        .category-card {
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            margin-bottom: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .category-card:hover {
            transform: translateY(-10px);
        }

        .category-icon {
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #FF6B6B;
            color: white;
            font-size: 3rem;
        }

        .category-content {
            padding: 20px;
            text-align: center;
            background: white;
        }

        .category-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #2C3E50;
        }

        .category-count {
            color: #777;
            font-size: 0.9rem;
        }

        .category-link {
            text-decoration: none;
            color: inherit;
        }

        .category-link:hover {
            text-decoration: none;
        }

        .category-card.development {
            background: linear-gradient(45deg, #FF6B6B, #FF8E53);
        }

        .category-card.design {
            background: linear-gradient(45deg, #4E65FF, #92EFFD);
        }

        .category-card.marketing {
            background: linear-gradient(45deg, #45B649, #DCE35B);
        }

        .category-card.business {
            background: linear-gradient(45deg, #834D9B, #D04ED6);
        }

        .category-card.photography {
            background: linear-gradient(45deg, #F7971E, #FFD200);
        }

        .category-card.music {
            background: linear-gradient(45deg, #11998E, #38EF7D);
        }
    </style>
</head>

<body>
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
                    <a href="../index.php" class="nav-item nav-link">Accueil</a>
                    <a href="./courses.php" class="nav-item nav-link">Cours</a>
                    <a href="./ListCategory.php" class="nav-item nav-link active">Categories</a>
                </div>
                <?php if (isset($_SESSION['utilisateur'])): ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle"
                            style="text-decoration: none;color: black;font-weight: bold;border-radius: 5px;padding: 5px 10px;background-color: #f5f5f5;"
                            data-toggle="dropdown"><?php echo $_SESSION['utilisateur']['nom']; ?></a>
                        <div class="dropdown-menu m-0" style="border-radius: 5px;">
                            <?php if ($_SESSION['utilisateur']['role'] == 'etudiant'): ?>
                                <a href="./mesCours.php" class="dropdown-item">Mes Cours</a>
                            <?php endif; ?>
                            <a href="../actions/lougout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i></a>
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
            <h1 class="text-white display-4">Categories</h1>
            <div class="d-inline-flex text-white mb-5">
                <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Categories</p>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Categories Start -->
    <div class="container-fluid">
        <div class="container">
            <div class="row mx-0 justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center position-relative mb-5">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Nos Catalogues
                        </h6>
                        <h1 class="display-5">Explorez nos domaines d'apprentissage</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach ($categoryObj as $category): ?>
                    <div class="col-lg-4 col-md-6">
                        <a href="courses.php?category_id=<?= $category->id_category ?>" class="category-link">
                            <div class="category-card development">
                                <div class="category-icon">
                                    <img src="/assets/img/ycd.png" alt="" style="width: 150px; height: 150px;">
                                </div>
                                <div class="category-content">
                                    <h3 class="category-title"><?= $category->category_name ?></h3>
                                    <p class="category-count">150 cours disponibles</p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <nav>
                <ul class="pagination justify-content-center mb-0">
                    <li class="page-item">
                        <?php if ($currentPage > 1): ?>
                            <a class="page-link" href="?url=categoryList&page=<?= $currentPage - 1 ?>"><i
                                    class="fa fa-angle-double-left"></i></a>
                        <?php else: ?>
                            <a class="page-link disabled"><i class="fa fa-angle-double-left"></i></a>
                        <?php endif; ?>
                    </li>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <?php if ($currentPage == $i): ?>
                            <li class="page-item active"><a class="page-link" href="#"><?= $i ?></a></li>
                        <?php else: ?>
                            <li class="page-item"><a class="page-link" href="?url=categoryList&page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <li class="page-item">
                        <?php if ($currentPage < $totalPages): ?>
                            <a class="page-link" href="?url=categoryList&page=<?= $currentPage + 1 ?>"><i
                                    class="fa fa-angle-double-right"></i></a>
                        <?php else: ?>
                            <a class="page-link disabled"><i class="fa fa-angle-double-right"></i></a>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
    <!-- Categories End -->

    <!-- Footer Start -->
    <div class="container-fluid position-relative overlay-top bg-dark text-white-50 py-5" style="margin-top: 90px;">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <a href="index.html" class="navbar-brand">
                        <h1 class="mt-n2 text-uppercase text-white"><i class="fa fa-book-reader mr-3"></i>YouDemy</h1>
                    </a>
                    <p class="m-0">YouDemy est une plateforme de formation en ligne qui propose des cours et des
                        formations dans divers domaines. Nous offrons des ressources éducatives et des outils pour vous
                        aider à améliorer vos compétences et à atteindre vos objectifs.</p>
                </div>
                <div class="col-md-6 mb-5">
                    <h3 class="text-white mb-4">Abonnez-vous à notre newsletter</h3>
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
                    <p class="m-0">Copyright &copy; <a class="text-white" href="#">YouDemy</a>. Tous droits réservés.
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

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i
            class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/easing/easing.min.js"></script>
    <script src="/assets/js/waypoints/waypoints.min.js"></script>
    <script src="/assets/js/counterup/counterup.min.js"></script>
    <script src="/assets/js/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="/assets/js/main.js"></script>
</body>

</html>