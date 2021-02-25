<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\VilleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VilleController extends AbstractController
{
    /**
     * @Route("/villes", name="villes")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function index(EntityManagerInterface $em): Response
    {
       $villes =  $em->getRepository(Ville::class)->findAll();

        return $this->render('ville/index.html.twig', [
            'villes' => $villes,
            'controller_name' => 'VilleController',
        ]);
    }

    /**
     * @Route("/villes/ajouter", name="ville_ajouter")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function add(Request $request, EntityManagerInterface $em) {
        $ville = new Ville();
        $villeForm = $this->createForm(VilleType::class, $ville);
        $villeForm->handleRequest($request);

        if($villeForm->isSubmitted() && $villeForm->isValid()){
                $em->persist($ville);
                $em->flush();
                return $this->redirectToRoute('villes');
        }

        return $this->render('ville/add.html.twig', [
            'villeForm' => $villeForm->createView()
        ]);
    }
}