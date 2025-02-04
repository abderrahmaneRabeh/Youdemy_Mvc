<?php

namespace Models;

class Etudiant extends Utilisateur
{
    private $is_banned;
    private $id_etudiant;

    public function __construct($nom, $email, $password, $is_banned = 0, $id = null)
    {
        parent::__construct($nom, $email, $password, 'etudiant', $id);
        $this->is_banned = $is_banned;
    }

    public function save()
    {
        $sql = "INSERT INTO etudiants (id_utilisateur, is_baned) VALUES (:id_utilisateur, :is_baned) RETURNING id_etudiant";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_utilisateur' => $this->id_utilisateur, 'is_baned' => $this->is_banned]);

        $this->id_etudiant = $stmt->fetchColumn();
        return $this->id_etudiant;
    }

    public function __get($attr)
    {
        return $this->$attr;
    }

}
