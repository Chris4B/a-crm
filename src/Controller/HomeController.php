<?php

namespace App\Controller;


use App\Repository\ContactsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{

    public function index(ContactsRepository $contactsRepository):Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('login');
        }

        return $this->render("boards/home.html.twig", [
            'contacts' => $contactsRepository->LastContacts(),
        ]);
    }
}