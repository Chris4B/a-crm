<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Form\AddContactType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ContactController extends AbstractController
{
    /**
     * this function renders all the contact in the view
     * @param EntityManagerInterface $manager
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */

    public function index(EntityManagerInterface $manager, PaginatorInterface $paginator, Request $request): Response
    {
        $contacts = $manager->getRepository(Contacts::class)->findAll();
        $paginated = $paginator->paginate(
            $contacts,
            $request->query->getInt('page',1),10
        );


        return $this->render('contacts/index.html.twig',[
            'contacts'=>$paginated,
            ]);
    }

    /**
     * this function creates a new contact
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */

    public function newContact(Request $request, EntityManagerInterface $manager):Response
    {
            $contact = new Contacts();
            $form = $this->createForm(AddContactType::class, $contact);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
               $contact = $form->getData();

                $manager->persist($contact);
                $manager->flush();

                $this->addFlash('success','Votre contact a bien été crée');

                return $this->redirectToRoute('contact_index');



            }
        return $this->render('contacts/add.html.twig',[
            'new_contact' => $form->createView(),
            ]);
  }

    /**
     * this function updates a contact by id
     * @param Request $request
     * @param Contacts $contact
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[isGranted('ROLE_USER')]
    public function updateContact(Request $request, Contacts $contact, EntityManagerInterface $manager):Response
    {

        $form = $this->createForm(AddContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            $this->addFlash('success', 'Votre contact a bien mis à jour');

            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contacts/update.html.twig', [
            'contact' => $form->createView(),
        ]);


    }

    /**
     * this function delete a contact
     * @param EntityManagerInterface $manager
     * @param Contacts $contact
     * @return Response
     */
    public function deleteContact(EntityManagerInterface $manager, Contacts $contact):Response
    {

        $manager->remove($contact);
        $manager->flush();

        $this->addFlash('success', 'Votre contact a bien été supprimé');
        return $this->redirectToRoute('contact_index');

    }



}
