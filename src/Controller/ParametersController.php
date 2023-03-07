<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ParametersController extends AbstractController
{
    public function index():Response
    {
        return$this->render('parameters/index.html.twig');
    }
}