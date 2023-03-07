<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('register/index.html.twig');
    }
}