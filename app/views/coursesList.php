<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>YouDemy - List Des courses</title>
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
        .img-fluid {
            background-size: cover;
            object-fit: cover;
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
                                <a href="./pages/mesCours.php" class="dropdown-item">Mes Cours</a>
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
            <h1 class="text-white display-4">Courses</h1>
            <div class="d-inline-flex text-white mb-5">
                <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Courses</p>
            </div>

        </div>
    </div>
    <!-- Header End -->
    <!-- Courses Start -->
    <div class="container-fluid ">
        <div class="container">
            <div class="row mx-0 justify-content-center">
                <div class="col-lg-10">
                    <div class="section-title text-center position-relative mb-5">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Nos Cours</h6>
                        <h2 class="display-5">Découvrez nos dernières publications de cours</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-4 mb-5">
                <div class="col-lg-8">
                    <input class="form-control border-0 shadow-sm px-4" style="background-color: #f5f5f5;" type="text"
                        placeholder="Rechercher un cours" aria-label="Search" id="searchCours">
                </div>
                <div class="col-lg-4">
                    <div class="d-flex align-items-center justify-content-end">
                        <form action="./index.php" class="d-flex align-items-center" method="GET">
                            <input type="hidden" name="url" value="coursesList">
                            <select name="tag_filter" id="tag_filter" class="form-control border-0 shadow-sm px-4"
                                style="background-color: #f5f5f5;" onchange="this.form.submit()">
                                <option value="0" selected>Sélectionnez des mots-clés</option>
                                <?php if (!empty($tagsObj)): ?>
                                    <?php foreach ($tagsObj as $tag): ?>
                                        <?php if ($filter == $tag->id_tag): ?>
                                            <option value="<?php echo $tag->id_tag; ?>" selected>
                                                <?php echo $tag->tag_name; ?>
                                            </option>
                                        <?php else: ?>
                                            <option value="<?php echo $tag->id_tag; ?>">
                                                <?php echo $tag->tag_name; ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="0" disabled>Sélectionnez des mots-clés</option>
                                <?php endif; ?>
                            </select>
                        </form>

                    </div>
                </div>
            </div>

            <div class="row" id="listCours">
                <?php if (!empty($listCoursObj)): ?>
                    <?php foreach ($listCoursObj as $cours): ?>
                        <div class="col-lg-4 col-md-6 pb-4">
                            <a class="courses-list-item position-relative d-block overflow-hidden mb-2"
                                href="./index.php?url=courseDetail& id=<?= $cours->id_cour ?>">
                                <img class="img-fluid" src="<?= $cours->imgPrincipale_cours ?>" alt="<?= $cours->titre_cour ?>">
                                <div class="courses-text">
                                    <h4 class="text-center text-white px-3"><?= $cours->titre_cour ?></h4>
                                    <div class="border-top w-100 mt-3">
                                        <div class="d-flex justify-content-between p-4">
                                            <span class="text-white"><i class="fa fa-user mr-2"></i><?= $cours->id_enseignant ?>
                                            </span>
                                            <span class="text-white"><?= $cours->category_id ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12 text-center my-5">
                        <h3 class="text-primary font-weight-bold">Aucun cours disponible pour le moment.</h3>
                        <p class="text-muted">Nous sommes désolés, mais nous n'avons pas encore de cours dans cette
                            catégorie. Nous vous invitons à consulter nos autres cours.</p>
                    </div>

                <?php endif; ?>

                <div class="col-12">
                    <nav>
                        <ul class="pagination justify-content-center mb-0">
                            <li class="page-item">
                                <?php if ($currentPage > 1): ?>
                                    <a class="page-link" href="?url=coursesList&page=<?= $currentPage - 1 ?>"><i
                                            class="fa fa-angle-double-left"></i></a>
                                <?php else: ?>
                                    <a class="page-link disabled"><i class="fa fa-angle-double-left"></i></a>
                                <?php endif; ?>
                            </li>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <?php if ($currentPage == $i): ?>
                                    <li class="page-item active"><a class="page-link" href="#"><?= $i ?></a></li>
                                <?php else: ?>
                                    <li class="page-item"><a class="page-link"
                                            href="?url=coursesList&page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <li class="page-item">
                                <?php if ($currentPage < $totalPages): ?>
                                    <a class="page-link" href="?url=coursesList&page=<?= $currentPage + 1 ?>"><i
                                            class="fa fa-angle-double-right"></i></a>
                                <?php else: ?>
                                    <a class="page-link disabled"><i class="fa fa-angle-double-right"></i></a>
                                <?php endif; ?>
                            </li>
                        </ul>
                    </nav>
                </div>
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


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i
            class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script>
        let searchCours = document.getElementById("searchCours");
        let listCours = document.getElementById("listCours");

        searchCours.addEventListener("input", function (event) {
            let searchValue = event.target.value;

            if (searchValue.length > 0) {
                fetch(`./index.php?url=FetchCourses&search=${searchValue}`)
                    .then(response => response.json())
                    .then(articles => {

                        listCours.innerHTML = "";

                        if (articles.length == 0) {
                            let div = document.createElement("div");
                            div.className = "col-lg-4 col-md-6 pb-4";
                            div.innerHTML = `
                            <div class="alert alert-danger" role="alert">
                                Aucun cours n'a &eacute;t&eacute; trouv&eacute;.
                            </div>
                            `;
                            listCours.appendChild(div);
                        }
                        articles.forEach(article => {
                            let div = document.createElement("div");
                            div.className = "col-lg-4 col-md-6 pb-4";
                            div.innerHTML = `
                            <a class="courses-list-item position-relative d-block overflow-hidden mb-2" href="./CourseDetails.php?id=${article.id_cour}">
                                <img class="img-fluid" src="${article.imgprincipale_cours}" alt="${article.titre_cour}">
                                <div class="courses-text">
                                    <h4 class="text-center text-white px-3">${article.titre_cour}</h4>
                                    <div class="border-top w-100 mt-3">
                                        <div class="d-flex justify-content-between p-4">
                                            <span class="text-white"><i class="fa fa-user mr-2"></i>${article.nom}
                                            </span>
                                            <span class="text-white">${article.category_name}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            `;
                            listCours.appendChild(div);

                        });


                    })
            }
        })
    </script>

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