<?php

namespace Controllers;

class AuthController
{
    public function login()
    {
        require '../app/views/login.php';
    }

    public function logout()
    {
        header('Location: ../../index.php?url=home');
    }

    public function register()
    {
        require '../app/views/register.php';
    }
}