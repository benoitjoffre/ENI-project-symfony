<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Form\LieuType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LieuController extends AbstractController
{
    #[Route('/lieu', name: 'lieu')]
    public function index(): Response
    {
        return $this->render('lieu/index.html.twig', [
            'controller_name' => 'LieuController',
        ]);
    }


    /**
     * @Route("/lieux/ajouter", name="lieu_ajouter")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function add(Request $request, EntityManagerInterface $em) {
        $lieu = new Lieu();
        $lieuForm = $this->createForm(LieuType::class, $lieu);
        $lieuForm->handleRequest($request);

        if($lieuForm->isSubmitted() && $lieuForm->isValid()){
            $em->persist($lieu);
            $em->flush();
            return $this->redirectToRoute('sortie_ajouter');
        }

        return $this->render('lieu/add.html.twig', [
            'lieuForm' => $lieuForm->createView()
        ]);
    }
}
