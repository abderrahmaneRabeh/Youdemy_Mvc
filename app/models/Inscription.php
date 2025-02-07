<?php

namespace Models;

use Core\Database;

class Inscription
{

    private $id_insc;
    private $id_etudiant;
    private $id_cour;
    private $date_insc;

    public function __construct($id_etudiant, $id_cour, $date_insc = null, $id_insc = null)
    {
        $this->id_insc = $id_insc;
        $this->id_etudiant = $id_etudiant;
        $this->id_cour = $id_cour;
        $this->date_insc = $date_insc;
    }

    public static function AjouterNouvelleInscription($ObjInscription)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "INSERT INTO inscription(id_etudiant, id_cour) VALUES (:id_etudiant, :id_cour)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_etudiant', $ObjInscription->id_etudiant);
        $stmt->bindValue(':id_cour', $ObjInscription->id_cour);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public static function getUserInscriptions($id_etudiant, $id_cour)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM inscription WHERE id_etudiant = :id_etudiant and id_cour = :id_cour";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_etudiant', $id_etudiant);
        $stmt->bindValue(':id_cour', $id_cour);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public static function countTotalEtudiantsInscrits()
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT COUNT(DISTINCT id_etudiant) as total_etudiants FROM inscription";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch()['total_etudiants'];
    }

    public static function getEnseignantInscriptions($id_enseignant)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT  co.id_cour,
                        co.titre_cour,
                        COUNT(i.id_etudiant) as total_etudiants,
                        MIN(i.date_insc) as first_insc_date
                FROM inscription i 
                JOIN cours co ON i.id_cour = co.id_cour 
                WHERE co.id_enseignant = :id_enseignant 
                GROUP BY co.id_cour, co.titre_cour";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_enseignant', $id_enseignant);
        $stmt->execute();
        return $stmt->fetchAll();

        // min(i.date_insc) as first_insc_date pour obtenir la date de la première inscription
    }

    public static function CourseEtudiantInscite($id_cour)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * from utilisateurs u JOIN etudiants e on u.id_utilisateur = e.id_utilisateur JOIN inscription i on i.id_etudiant = e.id_etudiant JOIN cours c on c.id_cour = i.id_cour WHERE c.id_cour = :id_cour";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_cour', $id_cour);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function __get($attr)
    {
        return $this->$attr;
    }
}