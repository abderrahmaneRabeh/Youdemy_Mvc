<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>YouDemy - Enseignant Dashboard</title>
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
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fa fa-book-reader mr-2"></i>YouDemy</h3>
        </div>
        <div class="sidebar-menu">
            <a href="../index.php?url=StatistiquesEnseignant" class="menu-item">
                <i class="fas fa-tachometer-alt"></i>Dashboard
            </a>
            <a href="./index.php?url=GestionCoursEnseignant" class="menu-item active">
                <i class="fas fa-graduation-cap"></i>Cours
            </a>
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
                    <span>Enseignant User</span>
                <?php endif; ?>
            </div>
            <a href="./index.php?url=logout"
                style="text-decoration: none;color: black;font-weight: bold;border-radius: 5px;padding: 5px 10px;background-color:rgb(1, 86, 255);">
                <i class="fas fa-sign-out-alt" style="color: white;"></i>
            </a>
        </div>
        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
                <span class="text-muted">Gérez vos cours efficacement</span>
                <a class="btn btn-primary text-white" href="./index.php?url=AddCourse">
                    <i class="fas fa-plus-circle"></i> Ajouter un nouveau cours
                </a>
            </div>

        </div>

        <!-- Recent Activity -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <div class="recent-activity">
            <h4 class="mb-4">List des Courses</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre du cours</th>
                            <th>Description du cours</th>
                            <th>Category</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($coursesObj as $course): ?>
                            <tr>
                                <td><?= $course->id_cour; ?></td>
                                <td><?= $course->titre_cour; ?></td>
                                <td><?= substr($course->description_cours, 0, 50) ?></td>
                                <td><?= $course->category_id; ?></td>
                                <td class="text-center">
                                    <a href="./index.php?url=DeleteCourse&id=<?php echo $course->id_cour; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Voulez-vous vraiment supprimer ce cours ?')"><i
                                            class="fas fa-trash"></i></a>
                                    <a href="../pages/ModifierCours__form.php?id=<?php echo $course->id_cour; ?>"
                                        class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
    </script>
</body>

</html>