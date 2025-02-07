<?php

namespace Models;

use Core\Database;

class Tag
{
    private $db;
    public $id_tag;
    public $tag_name;

    public function __construct($tag_name, $id_tag = null)
    {
        $this->db = Database::getInstance()->getConnection();
        $this->tag_name = $tag_name;
        $this->id_tag = $id_tag;
    }

    public static function getAllTags()
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM tags";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function createNewTag($tag)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "INSERT INTO tags (tag_name) VALUES (:tag_name)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':tag_name', $tag);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public static function deleteTag($id_tag)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "DELETE FROM tags WHERE id_tag = :id_tag";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_tag', $id_tag);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public static function getTagById($id_tag)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM tags WHERE id_tag = :id_tag";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_tag', $id_tag);
        $stmt->execute();
        return $stmt->fetch();
    }

    public static function updateTag($id_tag, $tag_name)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "UPDATE tags SET tag_name = :tag_name WHERE id_tag = :id_tag";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_tag', $id_tag);
        $stmt->bindValue(':tag_name', $tag_name);
        $stmt->execute();
        return $stmt->rowCount();

    }

    public static function AjouterCoursTags($tag, $id_cours)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "INSERT INTO cours_tags(id_cour, id_tag) VALUES (:id_cour, :id_tag)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_cour', $id_cours);
        $stmt->bindValue(':id_tag', $tag);
        $stmt->execute();
        return $stmt->rowCount();
    }
    public function __get($attr)
    {
        return $this->$attr;
    }
}