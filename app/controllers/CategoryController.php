<?php

namespace Controllers;

use Core\Controller;
use Models\Category;

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

}