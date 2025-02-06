<?php

namespace Controllers;

session_start();

use Core\Controller;
use Models\Utilisateur;
class UserController extends Controller
{
    public function DeleteEtudiant()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $IsUserDeleted = Utilisateur::DeleteUser($id);

            if ($IsUserDeleted) {
                $_SESSION['success_etudiant'] = "L'etudiant a été supprimé avec succès !";
                header('Location: ./index.php?url=userPanel');

            } else {
                $_SESSION['error_etudiant'] = "L'etudiant n'a pas pu être supprimé.";
                header('Location: ./index.php?url=userPanel');
            }


        } else {
            $_SESSION['error_etudiant'] = "Une erreur s'est produite lors de la suppression de l'etudiant.";
            header('Location: ./index.php?url=userPanel');
        }
    }
    public function DeleteEnseignant()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $IsUserDeleted = Utilisateur::DeleteUser($id);

            if ($IsUserDeleted) {
                $_SESSION['success_enseignant'] = "L'enseignant a été supprimé avec succès !";
                header('Location: ./index.php?url=userPanel');

            } else {
                $_SESSION['error_enseignant'] = "L'enseignant n'a pas pu être supprimé.";
                header('Location: ./index.php?url=userPanel');
            }


        } else {
            $_SESSION['error_enseignant'] = "Une erreur s'est produite lors de la suppression de l'enseignant.";
            header('Location: ./index.php?url=userPanel');
        }
    }

    public function ActiveEnseignant()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $IsUserActive = Utilisateur::ActiveEnseignant($id);

            if ($IsUserActive) {
                $_SESSION['success_enseignant'] = "L'enseignant a été activé avec succès !";
                header('Location: ./index.php?url=userPanel');

            } else {
                $_SESSION['error_enseignant'] = "L'enseignant n'a pas pu être activé.";
                header('Location: ./index.php?url=userPanel');
            }


        } else {
            $_SESSION['error_enseignant'] = "Une erreur s'est produite lors de la suppression de l'enseignant.";
            header('Location: ./index.php?url=userPanel');
        }
    }

    public function BanEtudiant()
    {
        if (isset($_GET['id']) && isset($_GET['action'])) {
            $id = $_GET['id'];
            $action = $_GET['action'];

            if ($action == 1) {
                $msg = "Etudinat banner avec Success";
            } else {
                $msg = "Etudinat Activer avec Success";
            }

            $IsUserBan = Utilisateur::BanActiveEtudiant($id, $action);

            if ($IsUserBan) {
                $_SESSION['success_etudiant'] = $msg;
                header('Location: ./index.php?url=userPanel');

            } else {
                $_SESSION['error_etudiant'] = "L'etudiant n'a pas pu être activé.";
                header('Location: ./index.php?url=userPanel');
            }


        } else {
            $_SESSION['error_etudiant'] = "Une erreur s'est produite lors de la suppression de l'etudiant.";
            header('Location: ./index.php?url=userPanel');
        }
    }
}
