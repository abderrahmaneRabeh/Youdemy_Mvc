<?php

namespace Controllers;

use Core\Controller;
use Models\Tag;

class TagController extends Controller
{

    public function index()
    {
        echo "<pre>";
        print_r(Tag::getAllTags());
        echo "</pre>";

    }
}