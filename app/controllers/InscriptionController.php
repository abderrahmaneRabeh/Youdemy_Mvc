<?php

namespace Controllers;

use Models\Inscription;
use Core\Controller;

session_start();

class InscriptionController extends Controller
{

    public function AddNewInscription()
    {

        if (isset($_GET['id_cour'])) {
            $id_cour = $_GET['id_cour'];
            $id_etudiant = $_SESSION['id_etudiant'];

            $inscriptionObj = new Inscription($id_etudiant, $id_cour);
            $isInscription = Inscription::AjouterNouvelleInscription($inscriptionObj);

            if ($isInscription) {
                $_SESSION['success'] = "Inscription effectuée avec succès !";
                header('Location: ./index.php?url=courseDetail&id=' . $id_cour);
            } else {
                $_SESSION['error'] = "Une erreur s'est produite lors de l'inscription au cours.";
                header('Location: ./index.php?url=courseDetail&id=' . $id_cour);
            }
        } else {
            echo "Une erreur s'est produite lors de l'inscription au cours.";
        }
    }
}