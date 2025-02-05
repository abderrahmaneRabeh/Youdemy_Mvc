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

    public function __get($attr)
    {
        return $this->$attr;
    }
}