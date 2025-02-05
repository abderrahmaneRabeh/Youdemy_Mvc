<?php

namespace Controllers;

use Core\Controller;
use Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $page = $_GET['page'] ?? 1;
        $courses = Course::afficherCours($page);

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

        $this->view('coursesList', [
            'listCoursObj' => $listCoursObj,
            'currentPage' => $page,
            'totalPages' => $totalPages
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
}