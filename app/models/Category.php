<?php

namespace Models;
use Core\Database;

class Category
{
    private $db;

    private $id_category;
    private $category_name;

    public static $CategoryPerPage = 6;

    public function __construct($id_category, $category_name)
    {
        $this->db = Database::getInstance()->getConnection();
        $this->id_category = $id_category;
        $this->category_name = $category_name;
    }

    public static function Nbr_Category()
    {
        $db = Database::getInstance()->getConnection();
        $query = $db->prepare("SELECT COUNT(*) AS total FROM categories");
        $query->execute();
        $result = $query->fetch();
        return $result['total'];
    }
    public static function getCategoriesDetails($page = 1)
    {
        $db = Database::getInstance()->getConnection();
        $offset = ($page - 1) * self::$CategoryPerPage;

        $sql = "SELECT * FROM categories LIMIT :limit OFFSET :offset";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':limit', self::$CategoryPerPage, \PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    public static function getAllCategories()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function addCategory($category_name)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "INSERT INTO categories (category_name) VALUES (:category_name)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':category_name', $category_name);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public static function deleteCategory($id_category)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "DELETE FROM categories WHERE id_category = :id_category";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_category', $id_category);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public static function GetCategoryById($id_category)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM categories WHERE id_category = :id_category";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_category', $id_category);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function updateCategory($id_category, $category_name)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "UPDATE categories SET category_name = :category_name WHERE id_category = :id_category";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_category', $id_category);
        $stmt->bindValue(':category_name', $category_name);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public static function repartitionParCategorie()
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT categories.id_category, categories.category_name, COUNT(cours.id_cour) AS totalCour 
                FROM cours 
                JOIN categories ON cours.category_id = categories.id_category 
                GROUP BY categories.id_category, categories.category_name;
                ";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function __get($attr)
    {
        return $this->$attr;
    }
}