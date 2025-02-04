<?php

session_start();

// require_once '../middlewares/SeConnecterRedirect.php';
// seConnecterRedirect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>YouDemy - Login</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="../assets/img/ycd.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css">


</head>

<body>
    <div class="container">
        <div class="login-container">
            <div class="text-center mb-4">
                <a href="./index.php?page=home" style="text-decoration: none;">
                    <h1 class="login-title m-0 text-uppercase"><i class="fa fa-book-reader mr-3"></i>YouDemy</h1>
                </a>
                <p class="text-muted my-3">Bienvenue ! Veuillez vous connecter &agrave; votre compte.</p>
            </div>
            <?php if (isset($_SESSION['error_access'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['error_access'];
                    unset($_SESSION['error_access']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error_enseignant'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['error_enseignant'];
                    unset($_SESSION['error_enseignant']); ?>
                </div>
            <?php endif; ?>

            <form id="loginForm" method="post" action="../actions/SeConnecter_action.php">
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Adresse e-mail"
                        required>
                    <div class="invalid-feedback">Veuillez entrer une adresse e-mail valide.</div>
                    <?php if (isset($_SESSION['error_email'])): ?>
                        <div class="invalid-feedback" style="display: block;">
                            <?php echo $_SESSION['error_email'];
                            unset($_SESSION['error_email']);
                            ?>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe"
                        required>

                    <?php if (isset($_SESSION['error_password'])): ?>
                        <div class="invalid-feedback" style="display: block;">
                            <?php echo $_SESSION['error_password'];
                            unset($_SESSION['error_password']);
                            ?>
                        </div>
                    <?php endif; ?>

                </div>
                <button type="submit" class="btn btn-primary">Connexion</button>
            </form>
            <div class="register-link">
                <p>Vous n'avez pas de compte ? <a href="./index.php?url=register">Inscrivez-vous maintenant</a></p>
            </div>
        </div>
    </div>

    <script>
        let email = document.getElementById('email');
        email.addEventListener('input', function () {
            console.log(email.value);

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                email.classList.add('is-invalid');
                email.nextElementSibling.style.display = 'block';
            } else {
                email.classList.remove('is-invalid');
                email.nextElementSibling.style.display = 'none';
            }
        });
    </script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>