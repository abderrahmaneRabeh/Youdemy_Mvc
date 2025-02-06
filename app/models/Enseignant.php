<?php

namespace Models;

use Core\Database;
class Enseignant extends Utilisateur
{
    private $id_enseignant;
    private $is_active;

    public function __construct($nom, $email, $password, $is_active = false, $id = null)
    {
        parent::__construct($nom, $email, $password, 'enseignant', $id);
        $this->is_active = $is_active;
    }

    public function save()
    {
        $sql = "INSERT INTO enseignants (id_utilisateur, is_active) VALUES (:id_utilisateur, :is_active) RETURNING id_enseignant";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_utilisateur' => $this->id_utilisateur, 'is_active' => $this->is_active]);

        $this->id_enseignant = $stmt->fetchColumn();
        return $this->id_enseignant;
    }

    public static function getAllEnseignants()
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM utilisateurs u join enseignants e on u.id_utilisateur = e.id_utilisateur";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function __get($attr)
    {
        return $this->$attr;
    }

}
