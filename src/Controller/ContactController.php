<?php

namespace App\Controller;

use App\Entity\Contacts;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    public function index(EntityManagerInterface $manager, PaginatorInterface $paginator, Request $request): Response
    {
        $contacts = $manager->getRepository(Contacts::class)->findAll();
        $paginated = $paginator->paginate(
            $contacts,
            $request->request->getInt('page',1),10
        );


        return $this->render('contacts/index.html.twig',[
            'contacts'=>$paginated,
            ]);
    }
}
