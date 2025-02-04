<?php

namespace Controllers;
use Core\Controller;


class AuthController extends Controller
{
    public function login()
    {
        $this->view('login');
    }

    public function logout()
    {
        $this->view('logout');
    }

    public function register()
    {
        $this->view('register');
    }
}