<?php

namespace Controllers;

use Core\Controller;
use Models\Enseignant;
use Models\Etudiant;
use Models\Category;
use Models\Course;
use Models\Statistique;
use Models\Tag;

class DashboardController extends Controller
{
    public function Utilisateurs()
    {
        $enseignants = Enseignant::getAllEnseignants();
        $etudiants = Etudiant::getAllEtudiants();

        $utilisateursObjEnseignant = [];
        $utilisateursObjEtudiant = [];

        foreach ($enseignants as $enseignant) {
            $utilisateursObjEnseignant[] = new Enseignant($enseignant['nom'], $enseignant['email'], $enseignant['pw'], $enseignant['is_active'], $enseignant['id_utilisateur']);
        }

        foreach ($etudiants as $etudiant) {
            $utilisateursObjEtudiant[] = new Etudiant($etudiant['nom'], $etudiant['email'], $etudiant['pw'], $etudiant['is_baned'], $etudiant['id_utilisateur']);
        }


        $this->view('GestionUtilisateur', [
            'utilisateursObjEnseignant' => $utilisateursObjEnseignant,
            'utilisateursObjEtudiant' => $utilisateursObjEtudiant
        ]);
    }

    public function Statistiques()
    {
        $statistiqueModel = new Statistique();
        $TotalCourses = $statistiqueModel->Nombre_total_cours();
        $totalUtilisateurs = $statistiqueModel->Nombre_total_utilisateurs();
        $totalInscriptions = $statistiqueModel->Nombre_total_Inscriptions();
        $totalCategories = $statistiqueModel->Nombre_total_Categories();
        $totalTags = $statistiqueModel->Nombre_total_Tags();
        $CoursPlusEtudinat = $statistiqueModel->CoursPlusEtudinat();


        $this->view('StatistiquesGlobal', [
            'TotalCourses' => $TotalCourses,
            'totalUtilisateurs' => $totalUtilisateurs,
            'totalInscriptions' => $totalInscriptions,
            'totalCategories' => $totalCategories,
            'totalTags' => $totalTags,
            'CoursPlusEtudinat' => $CoursPlusEtudinat
        ]);
    }

    public function GestionCoursAdmin()
    {
        $courses = Course::getAllCours();

        $coursesObj = [];

        foreach ($courses as $course) {
            $coursesObj[] = new Course(
                $course['titre_cour'],
                $course['imgprincipale_cours'],
                $course['imgsecondaire_cours'],
                $course['description_cours'],
                $course['contenu_cours'],
                $course['category_name'],
                $course['nom'],
                $course['is_video'],
                $course['id_cour']
            );
        }

        $this->view('GestionCoursAdmin', [
            'coursesObj' => $coursesObj
        ]);
    }

    public function GestionTags()
    {

        $tags = Tag::getAllTags();

        $tagsObj = [];

        foreach ($tags as $tag) {
            $tagsObj[] = new Tag($tag['tag_name'], $tag['id_tag']);
        }
        $this->view('GestionTag', [
            'tagsObj' => $tagsObj
        ]);
    }

    public function GestionCategories()
    {

        $categories = Category::getAllCategories();

        $categoriesObj = [];
        foreach ($categories as $category) {
            $categoriesObj[] = new Category($category['id_category'], $category['category_name']);
        }

        $this->view('GestionCategory', [
            'categoryObj' => $categoriesObj
        ]);
    }
}