<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>YouDemy - Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="../../assets/img/ycd.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <style>
        /* Enhanced Stats Cards Styling */
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.08);
            height: 100%;
            margin-bottom: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .stat-card i {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .stat-card h3 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0.5rem 0;
            background: linear-gradient(45deg, #0156FF, #0091ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-card p {
            color: #666;
            font-size: 1rem;
            margin: 0;
        }

        /* Icon specific backgrounds */
        .stat-card .fa-user-friends {
            background: rgba(1, 86, 255, 0.1);
            color: #0156FF;
        }

        .stat-card .fa-book {
            background: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
        }

        .stat-card .fa-calendar-check {
            background: rgba(255, 152, 0, 0.1);
            color: #FF9800;
        }

        .stat-card .fa-list {
            background: rgba(156, 39, 176, 0.1);
            color: #9C27B0;
        }

        .stat-card .fa-tags {
            background: rgba(255, 87, 34, 0.1);
            color: #FF5722;
        }

        /* Animation */
        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-in {
            animation: countUp 0.5s ease-out forwards;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fa fa-book-reader mr-2"></i>YouDemy</h3>
        </div>
        <div class="sidebar-menu">
            <a href="./index.php?url=statistiques" class="menu-item active"><i
                    class="fas fa-tachometer-alt"></i>Dashboard</a>
            <a href="./index.php?url=userPanel" class="menu-item"><i class="fas fa-users"></i>Utilisateurs</a>
            <a href="./index.php?url=coursAdminPanel" class="menu-item"><i class="fas fa-graduation-cap"></i>Cours</a>
            <a href="./index.php?url=tagsPanel" class="menu-item"><i class="fas fa-tags"></i>Tags</a>
            <a href="./index.php?url=categoriesPanel" class="menu-item"><i class="fas fa-list"></i>Categories</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar d-flex justify-content-between align-items-center">
            <button class="btn btn-link d-md-none" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="user-profile">
                <?php if (isset($_SESSION['role'])): ?>
                    <span><?php echo $_SESSION['nom']; ?></span>
                <?php else: ?>
                    <span>Admin User</span>
                <?php endif; ?>
            </div>
            <a href="./index.php?url=logout"
                style="text-decoration: none;color: black;font-weight: bold;border-radius: 5px;padding: 5px 10px;background-color:rgb(1, 86, 255);">
                <i class="fas fa-sign-out-alt" style="color: white;"></i>
            </a>
        </div>

        <!-- Stats Cards -->
        <div class="row justify-content-center">
            <div class="col-md-2">
                <div class="stat-card">
                    <i class="fas fa-user-friends"></i>
                    <h3><?= $totalUtilisateurs ?></h3>
                    <p>Utilisateurs Total</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="stat-card">
                    <i class="fas fa-book"></i>
                    <h3><?= $TotalCourses ?></h3>
                    <p>Cours Total</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="stat-card">
                    <i class="fas fa-calendar-check"></i>
                    <h3><?= $totalInscriptions ?></h3>
                    <p>Inscriptions total</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="stat-card">
                    <i class="fas fa-list"></i>
                    <h3><?= $totalCategories ?></h3>
                    <p>Categories Total</p>
                </div>
            </div>
            <div class="col-md-2">
                <div class="stat-card">
                    <i class="fas fa-tags"></i>
                    <h3><?= $totalTags ?></h3>
                    <p>Total Mots-Clé</p>
                </div>
            </div>
        </div>
        <div class="p-3 bg-white rounded shadow-sm d-flex align-items-center justify-content-between mt-4"
            style="width: 83%;margin: auto;">
            <h4 class="d-inline-block text-muted mb-0"><span
                    class="animate-in text-primary"><?= $CoursPlusEtudinat['titre_cour'] ?></span> est le cours le plus
                étudiants:
            </h4>
            <h3 class="d-inline-block  text-primary ml-2 mb-0"><?= $CoursPlusEtudinat['total'] ?></h3>
        </div>

        <div class="top-enseignants mt-5">
            <h4 class="mb-4">Top 3 Enseignants</h4>
            <div class="list-group">
                <?php foreach ($TopTreeEnseignants as $enseignant): ?>
                    <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span><?= $enseignant['nom'] ?></span>
                        <span class="badge badge-primary badge-pill">Nombre de cours : <?= $enseignant['toptree'] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>




        <div class="recent-activity mt-4">
            <h4 class="mb-4">Répartition par catégorie</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>nom de category</th>
                            <th>nombre de courses</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($repartitionParCategorie as $category): ?>

                            <tr>
                                <td><?= $category['category_name'] ?></td>
                                <td>
                                    <a href="index.php?url=statistiques&category_id=<?= $category['id_category'] ?>">
                                        <?= $category['totalcour'] ?>
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php if (isset($_GET['category_id'])): ?>
            <div class="recent-activity">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="mb-0">Liste des étudiants inscrits au
                        <span class="text-primary">
                            <?= $categoryCourses[0]['category_name'] ?>
                        </span>
                    </h4>
                    <a class="btn btn-primary" style="margin-left: 10px;color:white;" href="index.php?url=statistiques"><i
                            class="fa fa-eye-slash"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titre du cours</th>
                                <th>Enseignant</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categoryCourses as $course): ?>
                                <tr>
                                    <td><?= $course['id_cour']; ?></td>
                                    <td><?= $course['titre_cour']; ?></td>
                                    <td><?= $course['nom']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div></div>
        <?php endif; ?>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

        <script>
            // Sidebar Toggle
            $("#sidebarToggle").click(function (e) {
                e.preventDefault();
                $(".sidebar").toggleClass("active");
                $(".main-content").toggleClass("active");
            });

            // Make menu items active on click
            $(".menu-item").click(function () {
                $(".menu-item").removeClass("active");
                $(this).addClass("active");
            });

            // Add this to your existing script section
            document.addEventListener('DOMContentLoaded', function () {
                // Animate numbers when in view
                const animateValue = (obj, start, end, duration) => {
                    let startTimestamp = null;
                    const step = (timestamp) => {
                        if (!startTimestamp) startTimestamp = timestamp;
                        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                        obj.innerHTML = Math.floor(progress * (end - start) + start);
                        if (progress < 1) {
                            window.requestAnimationFrame(step);
                        }
                    };
                    window.requestAnimationFrame(step);
                };

                // Create intersection observer
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const target = entry.target;
                            const endValue = parseInt(target.getAttribute('data-value'));
                            animateValue(target, 0, endValue, 2000);
                            entry.target.classList.add('animate-in');
                            observer.unobserve(target);
                        }
                    });
                }, { threshold: 0.5 });

                // Observe all stat card numbers
                document.querySelectorAll('.stat-card h3').forEach(el => {
                    const currentValue = el.innerHTML;
                    el.setAttribute('data-value', currentValue);
                    el.innerHTML = '0';
                    observer.observe(el);
                });
            });
        </script>
</body>

</html>