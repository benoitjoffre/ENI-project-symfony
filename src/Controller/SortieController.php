<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{


    /**
     * @Route("/sorties/ajouter", name="sortie_ajouter")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function add(Request $request, EntityManagerInterface $em) {
        $sortie = new Sortie();
        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $sortieForm->handleRequest($request);


        if($sortieForm->isSubmitted() && $sortieForm->isValid())
        {
            $sortie->setOrganisateur($this->getUser());
            $sortie->setEtat(1);

            if ($sortieForm->get('enregistre')->isClicked() )
            {
                $sortie->setEstPubliee(false);
                $em->persist($sortie);
                $em->flush();
                return $this->redirectToRoute('sortie_detail', ['id' => $sortie->getId()]);
            }

            if ($sortieForm->get('publie')->isClicked() )
            {
                $sortie->setEstPubliee(true);
                $em->persist($sortie);
                $em->flush();
                return $this->redirectToRoute('sortie_detail', ['id' => $sortie->getId()]);
            }
        }

        return $this->render('sortie/add.html.twig', [
            'sortieForm' => $sortieForm->createView()
        ]);
    }
}
