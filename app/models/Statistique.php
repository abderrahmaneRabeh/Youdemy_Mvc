<?php

namespace Models;

use Core\Database;

class Statistique
{
    public function getData($table)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT count(*) AS total FROM $table";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch()['total'];
    }

    public function Nombre_total_cours()
    {
        return $this->getData('cours');
    }
    public function Nombre_total_utilisateurs()
    {
        return $this->getData('utilisateurs');
    }
    public function Nombre_total_Inscriptions()
    {
        return $this->getData('inscription');
    }
    public function Nombre_total_Categories()
    {
        return $this->getData('categories');
    }
    public function Nombre_total_Tags()
    {
        return $this->getData('tags');
    }

    public function CoursPlusEtudinat()
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT COUNT(i.id_etudiant) AS total, co.titre_cour
                FROM cours co
                JOIN inscription i ON i.id_cour = co.id_cour
                GROUP BY co.id_cour, co.titre_cour
                ORDER BY COUNT(i.id_etudiant) DESC
                LIMIT 1;";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch();
    }
}