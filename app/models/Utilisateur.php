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
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public static function findEnseignantById($id_utilisateur)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM enseignants WHERE id_utilisateur = :id_utilisateur");
        $stmt->execute([':id_utilisateur' => $id_utilisateur]);
        return $stmt->fetch();
    }

    public static function findEtudiantById($id_utilisateur)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT id_etudiant FROM etudiants WHERE id_utilisateur = :id_utilisateur");
        $stmt->execute([':id_utilisateur' => $id_utilisateur]);
        return $stmt->fetch()['id_etudiant'];
    }

    public static function DeleteUser($id_utilisateur)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "DELETE FROM utilisateurs WHERE id_utilisateur = :id_utilisateur";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public static function ActiveEnseignant($id_utilisateur)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "UPDATE enseignants SET is_active = true WHERE id_utilisateur = :id_utilisateur";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public static function BanActiveEtudiant($id_utilisateur, $is_baned)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "UPDATE etudiants SET is_baned = :is_baned WHERE id_utilisateur = :id_utilisateur";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_utilisateur', $id_utilisateur);
        $stmt->bindValue(':is_baned', $is_baned);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function __get($attr)
    {
        return $this->$attr;
    }


}