<?php

namespace Controllers;

use Core\Controller;
use Models\Enseignant;
use Models\Etudiant;
use Models\Category;
use Models\Course;
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

    public function Statistiques()
    {
        $this->view('StatistiquesGlobal');
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