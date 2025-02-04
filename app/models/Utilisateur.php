<?php

namespace Models;
use Core\Database;

class Utilisateur
{
    protected $db;
    protected $id_utilisateur;
    protected $nom;
    protected $email;
    protected $password;
    protected $role;

    public function __construct($nom, $email, $password, $role, $id_utilisateur = null)
    {
        $this->db = Database::getInstance()->getConnection();
        $this->id_utilisateur = $id_utilisateur;
        $this->nom = $nom;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->role = $role;
    }

    public function save()
    {
        $sql = "INSERT INTO utilisateurs (nom, email, pw, role) 
        VALUES (:nom, :email, :password, :role) RETURNING id_utilisateur";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom' => $this->nom,
            ':email' => $this->email,
            ':password' => $this->password,
            ':role' => $this->role
        ]);

        $this->id_utilisateur = $stmt->fetchColumn();
        return $this->id_utilisateur;
    }

    public static function findByEmail($email)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetchColumn() > 0; // returns true if email exists, false otherwise
    }

    public function __get($attr)
    {
        return $this->$attr;
    }


}