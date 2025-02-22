<?php

namespace Models;
use Core\Database;
use PDO;
class Course
{
    private $db;
    private $id_cour;
    private $titre_cour;
    private $imgPrincipale_cours;
    private $imgSecondaire_cours;
    private $description_cours;
    private $contenu_cours;
    private $category_id;
    private $id_enseignant;
    private $is_video;

    public static $coursePerPage = 3;

    public function __construct(
        $titre_cour,
        $imgPrincipale_cours,
        $imgSecondaire_cours,
        $description_cours,
        $contenu_cours,
        $category_id,
        $id_enseignant,
        $is_video,
        $id_cour = null
    ) {
        $this->db = Database::getInstance()->getConnection();
        $this->titre_cour = $titre_cour;
        $this->imgPrincipale_cours = $imgPrincipale_cours;
        $this->imgSecondaire_cours = $imgSecondaire_cours;
        $this->description_cours = $description_cours;
        $this->contenu_cours = $contenu_cours;
        $this->category_id = $category_id;
        $this->id_enseignant = $id_enseignant;
        $this->is_video = $is_video;
        $this->id_cour = $id_cour;
    }

    public static function Nbr_Cours()
    {
        $db = Database::getInstance()->getConnection();
        $query = $db->prepare("SELECT count(*) AS total FROM cours");
        $query->execute();
        $result = $query->fetch();
        return $result['total'];
    }

    public static function afficherCours($page, $tagFilter = 0)
    {
        $offset = ($page - 1) * self::$coursePerPage;
        $db = Database::getInstance()->getConnection();

        if ($tagFilter > 0) {
            $stmt = $db->prepare("
                SELECT * 
                FROM cours co
                JOIN cours_tags tc ON co.id_cour = tc.id_cour
                JOIN tags t ON t.id_tag = tc.id_tag
                JOIN categories ca ON co.category_id = ca.id_category
                JOIN enseignants en ON co.id_enseignant = en.id_enseignant
                JOIN utilisateurs u ON en.id_utilisateur = u.id_utilisateur
                WHERE t.id_tag = :tag
                LIMIT :limit OFFSET :offset
            ");
            $stmt->bindParam(':tag', $tagFilter);
        } else {
            $stmt = $db->prepare("
                SELECT * 
                FROM cours co
                JOIN categories ca ON co.category_id = ca.id_category
                JOIN enseignants en ON co.id_enseignant = en.id_enseignant
                JOIN utilisateurs u ON en.id_utilisateur = u.id_utilisateur
                LIMIT :limit OFFSET :offset
            ");
        }

        $stmt->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $stmt->bindValue(':limit', self::$coursePerPage, \PDO::PARAM_INT);
        $stmt->execute();

        $courses = $stmt->fetchAll();

        return $courses;
    }

    public static function fetchAllCourses($search)
    {
        $db = Database::getInstance()->getConnection();
        $search = "%$search%";
        $sql = "SELECT * FROM cours co join categories ca on 
        co.category_id = ca.id_category join enseignants en on 
        co.id_enseignant = en.id_enseignant join utilisateurs u on 
        en.id_utilisateur = u.id_utilisateur WHERE 
        co.titre_cour LIKE :search OR 
        ca.category_name LIKE :search OR 
        u.nom LIKE :search";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':search', $search);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function CourseDetails($id_cours)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM cours co join categories ca on 
        co.category_id = ca.id_category join enseignants en on 
        co.id_enseignant = en.id_enseignant join utilisateurs u on 
        en.id_utilisateur = u.id_utilisateur 
        WHERE co.id_cour = :id_cour";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_cour', $id_cours);
        $stmt->execute();
        $course = $stmt->fetch();

        return $course;
    }

    public static function CoursTag($id_cours)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM cours_tags join tags on 
        cours_tags.id_tag = tags.id_tag 
        WHERE id_cour = :id_cour";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_cour', $id_cours);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getUserInscriptions($id_etudiant, $id_cour)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM inscription WHERE 
        id_etudiant = :id_etudiant and 
        id_cour = :id_cour";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_etudiant', $id_etudiant);
        $stmt->bindValue(':id_cour', $id_cour);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public static function EtudinatsCours($id_utilisateur)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM cours c join inscription i on 
        c.id_cour = i.id_cour JOIN etudiants e on 
        e.id_etudiant = i.id_etudiant WHERE 
        e.id_utilisateur = :id_utilisateur";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getAllCours()
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM cours co join categories ca on 
        co.category_id = ca.id_category join enseignants en on
        co.id_enseignant = en.id_enseignant join utilisateurs u 
        on en.id_utilisateur = u.id_utilisateur ORDER BY co.id_cour";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function deleteCourse($id_cours)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "DELETE FROM cours WHERE id_cour = :id_cour";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_cour', $id_cours);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public static function EnseignantCourses($id_enseignant)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM cours co join categories ca on co.category_id = ca.id_category join enseignants en on co.id_enseignant = en.id_enseignant join utilisateurs u on en.id_utilisateur = u.id_utilisateur WHERE en.id_utilisateur = :id_utilisateur order by co.id_cour";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_utilisateur', $id_enseignant);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function ajouterNouveauCourse($CourseObj)
    {
        $sql = "INSERT INTO cours (
            titre_cour, 
            imgprincipale_cours, 
            imgsecondaire_cours, 
            description_cours, 
            contenu_cours, 
            category_id, 
            id_enseignant, 
            is_video
        ) VALUES (
            :titre_cour, 
            :imgPrincipale_cours, 
            :imgSecondaire_cours, 
            :description_cours, 
            :contenu_cours, 
            :category_id, 
            :id_enseignant, 
            :is_video
        ) RETURNING id_cour";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':titre_cour', $CourseObj->titre_cour);
        $stmt->bindValue(':imgPrincipale_cours', $CourseObj->imgPrincipale_cours);
        $stmt->bindValue(':imgSecondaire_cours', $CourseObj->imgSecondaire_cours);
        $stmt->bindValue(':description_cours', $CourseObj->description_cours);
        $stmt->bindValue(':contenu_cours', $CourseObj->contenu_cours);
        $stmt->bindValue(':category_id', $CourseObj->category_id, PDO::PARAM_INT);
        $stmt->bindValue(':id_enseignant', $CourseObj->id_enseignant, PDO::PARAM_INT);
        $stmt->bindValue(':is_video', $CourseObj->is_video, PDO::PARAM_BOOL);

        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public static function MyCourses($id_utilisateur)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM cours c join inscription i on c.id_cour = i.id_cour JOIN etudiants e on e.id_etudiant = i.id_etudiant WHERE e.id_utilisateur = :id_utilisateur";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function countTotalCours()
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT COUNT(*) as total_cours FROM cours";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch()['total_cours'];
    }

    public static function TopTreeEnseignants()
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT u.nom, COUNT(co.id_cour) as topTree 
                FROM cours co 
                JOIN enseignants en ON co.id_enseignant = en.id_enseignant 
                JOIN utilisateurs u ON u.id_utilisateur = en.id_utilisateur 
                GROUP BY u.nom, co.id_enseignant 
                ORDER BY topTree DESC 
                LIMIT 3;
                ";

        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function CategoryCourses($id_category)
    {
        $db = Database::getInstance()->getConnection();
        $sql = "SELECT * FROM cours c join enseignants e on c.id_enseignant = e.id_enseignant 
                join utilisateurs u on e.id_utilisateur = u.id_utilisateur 
                join categories ca on c.category_id = ca.id_category WHERE category_id = :id_category";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id_category', $id_category);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function __get($attr)
    {
        return $this->$attr;
    }
}