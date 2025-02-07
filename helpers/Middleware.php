<?php

namespace Helpers;

class Middleware
{
    public static function isAdmin()
    {
        if (!isset($_SESSION['admin'])) {
            $_SESSION['error_access'] = "Vous devez être connecté en tant qu'admin pour accéder à cette page.";
            header('Location: ./index.php?url=login');
            exit();
        }
    }
}