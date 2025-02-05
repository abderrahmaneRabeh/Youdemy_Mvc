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

    public function __get($attr)
    {
        return $this->$attr;
    }
}