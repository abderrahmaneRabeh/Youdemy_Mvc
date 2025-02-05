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
        session_destroy();
        header('Location: ./index.php?url=home');
        exit();
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

            $user = new Utilisateur($nom, $email, $password, $role);
            $userId = $user->save();

            if ($role == 'etudiant') {
                $etudiant = new Etudiant($nom, $email, $password, 0, $userId);
                $id_etudiant = $etudiant->save();
                $_SESSION['nom'] = $nom;
                $_SESSION['id_etudiant'] = $id_etudiant;
                $_SESSION['role'] = $role;
                header('Location: ./index.php?url=home');
                exit();

            } elseif ($role === 'enseignant') {
                $enseignant = new Enseignant($nom, $email, $password, 0, $userId);
                $id_enseignant = $enseignant->save();

                $_SESSION['nom'] = $nom;
                $_SESSION['id_enseignant'] = $id_enseignant;
                $_SESSION['role'] = $role;

                header('Location: ./index.php?url=home');
                exit();
            }

        }
    }

    public function processLogin()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $utilisateur = Utilisateur::findByEmail($email);

            if (!$utilisateur) {
                $_SESSION['error_email'] = "Cet email n'existe pas.";
                header('Location: ./index.php?url=login');
                exit();
            }
            // echo $utilisateur['pw'] . "<br>";
            // echo $password;

            if (!password_verify(trim($password), trim($utilisateur['pw']))) {
                $_SESSION['error_password'] = "Le mot de passe est incorrect.";
                header('Location: ./index.php?url=login');
                exit();
            }

            if ($utilisateur['role'] == 'etudiant') {
                $_SESSION['nom'] = $utilisateur['nom'];
                $_SESSION['id_etudiant'] = $utilisateur['id_utilisateur'];
                $_SESSION['role'] = $utilisateur['role'];
                header('Location: ./index.php?url=home');
                exit();
            } elseif ($utilisateur['role'] == 'enseignant') {
                $_SESSION['nom'] = $utilisateur['nom'];
                $_SESSION['id_enseignant'] = $utilisateur['id_utilisateur'];
                $_SESSION['role'] = $utilisateur['role'];
                header('Location: ./index.php?url=home');
                exit();
            }
        }

    }
}