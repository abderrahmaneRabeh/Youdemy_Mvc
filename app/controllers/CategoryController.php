<?php

namespace Controllers;

use Core\Controller;
use Models\Category;

session_start();


class CategoryController extends Controller
{

    public function index()
    {
        $page = $_GET['page'] ?? 1;
        $categories = Category::getCategoriesDetails($page);

        $totalCategories = Category::Nbr_Category();
        $totalPages = ceil($totalCategories / Category::$CategoryPerPage);

        $categoryObj = [];

        foreach ($categories as $cat) {
            $categoryObj[] = new Category($cat['id_category'], $cat['category_name']);
        }
        $this->view('categoriesList', [
            'categoryObj' => $categoryObj,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ]);
    }

    public function AddCategory()
    {
        $this->view('AjouterCategory');
    }

    public function processAjouterCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $category_name = $_POST['category_name'];
            $isAdded = Category::addCategory($category_name);

            if ($isAdded) {
                $_SESSION['success'] = "La catégorie a été ajoutée avec succès";
                header('Location: ./index.php?url=categoriesPanel');
            } else {
                $_SESSION['error'] = "La catégorie n'a pas pu être ajoutée";
                header('Location: ./index.php?url=categoriesPanel');
            }
        } else {
            $_SESSION['error'] = "Une erreur s'est produite lors de l'ajout de la catégorie";
            header('Location: ./index.php?url=categoriesPanel');
        }
    }

    public function SupprimerCategory()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $isDeleted = Category::DeleteCategory($id);
            if ($isDeleted) {
                $_SESSION['success'] = "La catégorie a été supprimée avec succès";
                header('Location: ./index.php?url=categoriesPanel');
            } else {
                $_SESSION['error'] = "La catégorie n'a pas pu être supprimée";
                header('Location: ./index.php?url=categoriesPanel');
            }
        } else {
            $_SESSION['error'] = "Une erreur s'est produite lors de la suppression de la catégorie";
            header('Location: ./index.php?url=categoriesPanel');
        }
    }

    public function EditCategory()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $category = Category::GetCategoryById($id);

            $categoryObj = new Category($category['id_category'], $category['category_name']);
            $this->view('EditCategory', ['categoryObj' => $categoryObj]);
        } else {
            $_SESSION['error'] = "Une erreur s'est produite lors de la modification de la catégorie";
            header('Location: ./index.php?url=categoriesPanel');
        }
    }

    public function processEditCategory()
    {
        if (isset($_POST['category_id']) && isset($_POST['category_name'])) {
            $id = $_POST['category_id'];
            $category_name = $_POST['category_name'];
            $isUpdated = Category::updateCategory($id, $category_name);
            if ($isUpdated) {
                $_SESSION['success'] = "La catégorie a été modifiée avec succès";
                header('Location: ./index.php?url=categoriesPanel');
            } else {
                $_SESSION['error'] = "La catégorie n'a pas pu être modifiée";
                header('Location: ./index.php?url=categoriesPanel');
            }
        } else {
            $_SESSION['error'] = "Une erreur s'est produite lors de la modification de la catégorie";
            header('Location: ./index.php?url=categoriesPanel');
        }
    }

}