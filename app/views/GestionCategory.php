<?php session_start(); ?>

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
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h3><i class="fa fa-book-reader mr-2"></i>YouDemy</h3>
        </div>
        <div class="sidebar-menu">
            <a href="index.php?url=statistiques" class="menu-item"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
            <a href="./index.php?url=userPanel" class="menu-item"><i class="fas fa-users"></i>Utilisateurs</a>
            <a href="./index.php?url=coursAdminPanel" class="menu-item"><i class="fas fa-graduation-cap"></i>Cours</a>
            <a href="./index.php?url=tagsPanel" class="menu-item"><i class="fas fa-tags"></i>Tags</a>
            <a href="./index.php?url=categoriesPanel" class="menu-item active"><i class="fas fa-list"></i>Categories</a>
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
                <?php if (isset($_SESSION['utilisateur'])): ?>
                    <span><?php echo $_SESSION['utilisateur']['nom']; ?></span>
                <?php else: ?>
                    <span>Admin User</span>
                <?php endif; ?>
            </div>
            <a href="../actions/lougout.php"
                style="text-decoration: none;color: black;font-weight: bold;border-radius: 5px;padding: 5px 10px;background-color:rgb(1, 86, 255);"><i
                    class="
                fas fa-sign-out-alt" style="color: white;"></i></a>
        </div>

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between align-items-center mb-4">
                <span class="text-muted">Gérez vos Categories efficacement</span>
                <a class="btn btn-primary text-white" href="../pages/AjouterCategory__form.php">
                    <i class="fas fa-plus-circle"></i> Ajouter un nouveau category
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
            <h4 class="mb-4">List des Category</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categoryObj as $Category): ?>
                            <tr>
                                <td><?php echo $Category->id_category; ?></td>
                                <td><?php echo $Category->category_name; ?></td>
                                <td class="text-center">
                                    <a href="../actions/SupprimerCategory_action.php?id=<?php echo $Category->id_category; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Voulez-vous vraiment supprimer ce cours ?')"><i
                                            class="fas fa-trash"></i></a>
                                    <a href="../pages/ModifierCategory__form.php?id=<?php echo $Category->id_category; ?>"
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