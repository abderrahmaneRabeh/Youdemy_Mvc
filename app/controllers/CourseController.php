<?php

namespace Controllers;

use Core\Controller;
use Models\Course;
use Models\Tag;
use Models\Category;

session_start();

class CourseController extends Controller
{
    public function index()
    {
        $page = $_GET['page'] ?? 1;
        $filter = $_GET['tag_filter'] ?? 0;
        $courses = Course::afficherCours($page, $filter);

        $totalCourses = Course::Nbr_Cours();
        $totalPages = ceil($totalCourses / Course::$coursePerPage);

        $listCoursObj = [];

        foreach ($courses as $course) {
            $listCoursObj[] = new Course(
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

        $tags = Tag::getAllTags();

        $tagsObj = [];

        foreach ($tags as $tag) {
            $id_tag = $tag['id_tag'];
            $tag_name = $tag['tag_name'];

            $tagsObj[] = new Tag($tag_name, $id_tag);
        }
        $this->view('coursesList', [
            'listCoursObj' => $listCoursObj,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'tagsObj' => $tagsObj,
            'filter' => $filter
        ]);
    }

    public function fetchCourses()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $ListCourses = Course::fetchAllCourses($search);
            echo json_encode($ListCourses);

        }
    }

    public function CourseDetails()
    {
        $id = $_GET['id'];

        $course = Course::CourseDetails($id);
        $courseTags = Course::CoursTag($id);
        if (isset($_SESSION['id_etudiant'])) {
            $isInscription = Course::getUserInscriptions($_SESSION['id_etudiant'], $id);
        } else {
            $isInscription = false;
        }

        $courseObj = new Course(
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

        $this->view('CourseDetail', [
            'course' => $courseObj,
            'courseTags' => $courseTags,
            'isInscription' => $isInscription
        ]);
    }

    public function MyCourses()
    {
        $courses = Course::EtudinatsCours($_SESSION['id_utilisateur']);
        $this->view('MyCours', [
            'MyCours' => $courses
        ]);
    }

    public function DeleteCourse()
    {

        if ($_SESSION['role'] != 'enseignant') {
            $redirect = './index.php?url=coursAdminPanel';
        } else {
            $redirect = './index.php?url=GestionCoursEnseignant';
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $isDeleted = Course::deleteCourse($id);

            if ($isDeleted) {
                $_SESSION['success'] = "Le cours a été supprimé avec succès.";
                header('Location: ' . $redirect);
            } else {
                $_SESSION['error'] = "Le cours n'a pas pu être supprimé.";
                header('Location: ' . $redirect);
            }
        } else {
            $_SESSION['error'] = "Une erreur s'est produite lors de la suppression du cours.";
            header('Location: ' . $redirect);
        }
    }

    public function AddCourse()
    {
        $categories = Category::getAllCategories();
        $tags = Tag::getAllTags();

        $categoryObj = [];

        foreach ($tags as $tag) {
            $id_tag = $tag['id_tag'];
            $tag_name = $tag['tag_name'];

            $tagsObj[] = new Tag($tag_name, $id_tag);
        }

        foreach ($categories as $cat) {
            $categoryObj[] = new Category($cat['id_category'], $cat['category_name']);

        }

        $this->view('AjouterCourse', [
            'categoryObj' => $categoryObj,
            'tagsObj' => $tagsObj
        ]);
    }

    public function processAjouterCours()
    {

        $toutEffectue = true;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $titre_cour = $_POST['titre_cour'];
            $imgPrincipale_cours = $_POST['imgPrincipale_cours'];
            $imgSecondaire_cours = $_POST['imgSecondaire_cours'];
            $description_cours = $_POST['description_cours'];
            $category_id = $_POST['category_id'];
            $tags = $_POST['tags'];

            $isVideo = 1;
            if (isset($_POST['contenu_cours_document']) || isset($_POST['contenu_cours_video'])) {

                if (empty($_POST['contenu_cours_document']) && !empty($_POST['contenu_cours_video'])) {
                    $isVideo = 1;
                }

                if (empty($_POST['contenu_cours_video']) && !empty($_POST['contenu_cours_document'])) {
                    $isVideo = 0;
                }

            }

            $courseObj = new Course(
                $titre_cour,
                $imgPrincipale_cours,
                $imgSecondaire_cours,
                $description_cours,
                $_POST['contenu_cours_document'],
                $category_id,
                $_SESSION['id_enseignant'],
                $isVideo
            );

            $lastInsertedId = $courseObj->ajouterNouveauCourse($courseObj);

            foreach ($tags as $tag) {
                $result = Tag::AjouterCoursTags($tag, $lastInsertedId);

                if (!$result) {
                    $toutEffectue = false;
                }
            }

            if ($toutEffectue) {
                $_SESSION['success'] = "Le cours a été ajouté avec succès.";
                header('Location: ./index.php?url=GestionCoursEnseignant');
            }

        } else {
            $toutEffectue = false;

            $_SESSION['error'] = "Une erreur s'est produite lors de l'ajout du cours.";
            header('Location: ./index.php?url=GestionCoursEnseignant');
        }
    }
}