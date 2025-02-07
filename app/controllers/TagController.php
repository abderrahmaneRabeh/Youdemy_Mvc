<?php

namespace Controllers;

use Core\Controller;
use Models\Tag;

session_start();

class TagController extends Controller
{
    public function AddTag()
    {
        $this->view("AjouterTag");
    }

    public function processAjouterTag()
    {
        $toutEffectue = true;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $tag_name = $_POST['tag_name'];

            foreach ($tag_name as $tag) {
                $isAjoute = Tag::createNewTag($tag);

                if (!$isAjoute) {
                    $toutEffectue = false;
                }
            }

            if ($toutEffectue) {
                $_SESSION['success'] = "Les tags ont bien été ajoutés";
                header('Location: ./index.php?url=tagsPanel');
                exit();
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout des tags. Veuillez r essayer plus tard";
                header('Location: ./index.php?url=tagsPanel');
                exit();
            }
        } else {
            $_SESSION['error'] = "Une erreur s'est produite lors de l'ajout des tags";
            header('Location: ./index.php?url=tagsPanel');
            exit();
        }
    }

    public function SupprimerTag()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $isDeleted = Tag::deleteTag($id);

            if ($isDeleted) {
                $_SESSION['success'] = "Le tag a été supprimé avec succès";
                header('Location: ./index.php?url=tagsPanel');
            } else {
                $_SESSION['error'] = "Le tag n'a pas pu être supprimé";
                header('Location: ./index.php?url=tagsPanel');
            }
        } else {
            $_SESSION['error'] = "Une erreur s'est produite lors de la suppression du tag";
            header('Location: ./index.php?url=tagsPanel');
        }
    }

    public function EditTag()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $tag = Tag::getTagById($id);
            $tagObj = new Tag($tag['tag_name'], $tag['id_tag']);
            $this->view("EditTag", ['tagObj' => $tagObj]);
        } else {
            $_SESSION['error'] = "Une erreur s'est produite lors de la modification du tag";
            header('Location: ./index.php?url=tagsPanel');
        }
    }

    public function processEditTag()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $tag_name = $_POST['tag_name'];
            $id_tag = $_POST['id_tag'];

            $idUpdated = Tag::updateTag($id_tag, $tag_name);

            if ($idUpdated) {
                $_SESSION['success'] = "Tag modifié avec succès.";
                header('Location: ./index.php?url=tagsPanel');
            } else {
                $_SESSION['error'] = "Tag non modifié.";
                header('Location: ./index.php?url=tagsPanel');
            }

        } else {
            $_SESSION['error'] = "Une erreur s'est produite lors de l'ajout du tag. Veuillez réessayer.";
            header('Location: ./index.php?url=tagsPanel');
        }
    }
}