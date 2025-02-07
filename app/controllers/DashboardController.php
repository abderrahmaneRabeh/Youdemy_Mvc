<?php

namespace Controllers;

use Core\Controller;
use Models\Enseignant;
use Models\Etudiant;
use Models\Category;
use Models\Course;
use Models\Statistique;
use Models\Tag;
use Models\Inscription;

session_start();

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

        $TopTreeEnseignants = Course::TopTreeEnseignants();
        $repartitionParCategorie = Category::repartitionParCategorie();

        if (isset($_GET['category_id'])) {
            $categoryCourses = Course::CategoryCourses($_GET['category_id']);
        } else {
            $categoryCourses = [];
        }


        $this->view('StatistiquesGlobal', [
            'TotalCourses' => $TotalCourses,
            'totalUtilisateurs' => $totalUtilisateurs,
            'totalInscriptions' => $totalInscriptions,
            'totalCategories' => $totalCategories,
            'totalTags' => $totalTags,
            'CoursPlusEtudinat' => $CoursPlusEtudinat,
            'TopTreeEnseignants' => $TopTreeEnseignants,
            'repartitionParCategorie' => $repartitionParCategorie,
            'categoryCourses' => $categoryCourses
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

    public function GestionCoursEnseignant()
    {
        if (isset($_SESSION['id_utilisateur'])) {
            $courses = Course::EnseignantCourses($_SESSION['id_utilisateur']);
        } else {
            $courses = [];
        }

        $coursesObj = [];

        foreach ($courses as $course) {
            $id_cours = $course['id_cour'];
            $title = $course['titre_cour'];
            $imgPrincipale_cours = $course['imgprincipale_cours'];
            $imgSecondaire_cours = $course['imgsecondaire_cours'];
            $contenu_cours = $course['contenu_cours'];
            $description = $course['description_cours'];
            $category_id = $course['category_name'];
            $id_enseignant = $course['nom'];
            $is_video = $course['is_video'];

            $coursesObj[] = new Course($title, $imgPrincipale_cours, $imgSecondaire_cours, $description, $contenu_cours, $category_id, $id_enseignant, $is_video, $id_cours);
        }

        $this->view('GestionCoursEnseignant', [
            'coursesObj' => $coursesObj
        ]);
    }

    public function StatistiquesEnseignant()
    {
        if (isset($_GET['id_cour'])) {
            $id_cour = $_GET['id_cour'];

            $CourseEtudiantInscite = Inscription::CourseEtudiantInscite($id_cour);
        } else {
            $CourseEtudiantInscite = [];
        }

        $countTotalEtudiantsInscrits = Inscription::countTotalEtudiantsInscrits();
        $enseignantInscriptions = Inscription::getEnseignantInscriptions($_SESSION['id_enseignant']);
        $countTotalCours = Course::countTotalCours();
        $this->view('StatistiquesEnseignant', [
            'countTotalEtudiantsInscrits' => $countTotalEtudiantsInscrits,
            'countTotalCours' => $countTotalCours,
            'enseignantInscriptions' => $enseignantInscriptions,
            'EtudinatCourseInscrit' => $CourseEtudiantInscite
        ]);
    }
}