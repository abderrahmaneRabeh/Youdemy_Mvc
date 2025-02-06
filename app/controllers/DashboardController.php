<?php

namespace Controllers;

use Core\Controller;
use Models\Enseignant;
use Models\Etudiant;

class DashboardController extends Controller
{
    public function Utilisateurs()
    {
        $enseignants = Enseignant::getAllEnseignants();
        $etudiants = Etudiant::getAllEtudiants();

        $utilisateursObjEnseignant = [];
        $utilisateursObjEtudiant = [];

        foreach ($enseignants as $enseignant) {
            $utilisateursObjEnseignant[] = new Enseignant($enseignant['nom'], $enseignant['email'], $enseignant['pw'], $enseignant['is_active'], $enseignant['id_enseignant']);
        }

        foreach ($etudiants as $etudiant) {
            $utilisateursObjEtudiant[] = new Etudiant($etudiant['nom'], $etudiant['email'], $etudiant['pw'], $etudiant['is_baned'], $etudiant['id_etudiant']);
        }


        $this->view('GestionUtilisateur', [
            'utilisateursObjEnseignant' => $utilisateursObjEnseignant,
            'utilisateursObjEtudiant' => $utilisateursObjEtudiant
        ]);
    }
}