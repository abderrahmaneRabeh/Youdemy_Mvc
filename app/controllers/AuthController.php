<?php

namespace Controllers;
use Core\Controller;
use Models\Enseignant;
use Models\Etudiant;
use Models\Utilisateur;

session_start();



class AuthController extends Controller
{
    public function login()
    {
        $this->view('login');
    }

    public function logout()
    {
        $this->view('logout');
    }

    public function register()
    {
        $this->view('register');
    }

    public function processRegistration()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $nom = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            $role = $_POST['role'];

            if ($password !== $confirmPassword) {
                $_SESSION['error_password'] = "Les mots de passe ne correspondent pas.";
                header('Location: ./index.php?url=register');
                exit();
            }

            if (Utilisateur::findByEmail($email)) {
                $_SESSION['error_email'] = "Cet email est déjà utilisé.";
                header('Location: ./index.php?url=register');
                exit();
            }

            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

            $user = new Utilisateur($nom, $email, $passwordHashed, $role);
            $userId = $user->save();

            if ($role === 'etudiant') {
                $etudiant = new Etudiant($nom, $email, $passwordHashed, 0, $userId);
                $id_etudiant = $etudiant->save();
                $_SESSION['success'] = "Inscription reussie. Vous pouvez maintenant vous connecter.";

                $_SESSION['utilisateur'] = $etudiant;
                $_SESSION['id_etudiant'] = $id_etudiant;
                $_SESSION['role'] = $role;

                header('Location: ./index.php?url=home');
                exit();

            } elseif ($role === 'enseignant') {
                $enseignant = new Enseignant($nom, $email, $passwordHashed, 0, $userId);
                $id_enseignant = $enseignant->save();

                $_SESSION['success'] = "Inscription reussie. Vous pouvez maintenant vous connecter.";

                $_SESSION['utilisateur'] = $enseignant;
                $_SESSION['id_enseignant'] = $id_enseignant;
                $_SESSION['role'] = $role;

                header('Location: ./index.php?url=home');
                exit();
            }

        }
    }
}