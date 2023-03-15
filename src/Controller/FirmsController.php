<?php

namespace App\Controller;

use App\Entity\Firms;
use App\Form\FirmsType;
use App\Repository\FirmsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



class FirmsController extends AbstractController
{


    public function index(FirmsRepository $firmsRepository, EntityManagerInterface $manager, PaginatorInterface $paginator, Request $request): Response
    {
        $firms = $manager->getRepository(Firms::class)->findAll();
        $paginated = $paginator->paginate(
            $firms,
            $request->query->getInt('page',1),10);


        return $this->render('firms/index.html.twig', [
            'firms' => $paginated,
        ]);
    }



    public function addFirm(Request $request, FirmsRepository $firmsRepository): Response
    {
        $firm = new Firms();
        $form = $this->createForm(FirmsType::class, $firm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $firmsRepository->save($firm, true);

            $this->addFlash('success', 'l\'entreprise a bien été créée');

            return $this->redirectToRoute('firm_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('firms/new.html.twig', [
            'firm' => $firm,
            'form' => $form,
        ]);
    }

//    #[Route('/{id}', name: 'app_firms_show', methods: ['GET'])]
//    public function show(Firms $firm): Response
//    {
//        return $this->render('firms/show.html.twig', [
//            'firm' => $firm,
//        ]);
//    }


    public function updateFirm(Request $request, Firms $firm, FirmsRepository $firmsRepository): Response
    {
        $form = $this->createForm(FirmsType::class, $firm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $firmsRepository->save($firm, true);

            $this->addFlash('success', 'les informations ont été mise à jour');

            return $this->redirectToRoute('firm_index', [], Response::HTTP_SEE_OTHER);
        }



        return $this->render('firms/update.html.twig', [
            'firm' => $firm,
            'form' => $form,
        ]);
    }


    public function deleteFirm(Request $request, Firms $firm, FirmsRepository $firmsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$firm->getId(), $request->request->get('_token'))) {
            $firmsRepository->remove($firm, true);


        }
        $this->addFlash('success', 'les informations sont supprimées');
        return $this->redirectToRoute('firm_index', [], Response::HTTP_SEE_OTHER);
    }
}
