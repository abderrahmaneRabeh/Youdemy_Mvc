<?php

namespace Models;

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

    public function __get($attr)
    {
        return $this->$attr;
    }

}
