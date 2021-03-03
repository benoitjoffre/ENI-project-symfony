<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Form\SortieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/sorties/ajouter", name="sortie_ajouter")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function add(Request $request, EntityManagerInterface $em) {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_REMEMBERED");

        $sortie = new Sortie();
        $sortieForm = $this->createForm(SortieType::class, $sortie);
        $sortieForm->handleRequest($request);


        if($sortieForm->isSubmitted() && $sortieForm->isValid())
        {
            $sortie->setOrganisateur($this->getUser());

            $sortie->setEtat(1);

            if ($sortieForm->get('enregistrer')->isClicked() )
            {
                $sortie->setEstPubliee(false);
                $em->persist($sortie);
                $em->flush();
                $this->addFlash('success', 'Votre sortie est enregistrée !');

                return $this->redirectToRoute('sortie_detail', ['id' => $sortie->getId()]);
            }

            if ($sortieForm->get('publier')->isClicked() )
            {
                $sortie->setEstPubliee(true);
                $em->persist($sortie);
                $em->flush();
                $this->addFlash('success', 'Votre sortie est publiée !');
                return $this->redirectToRoute('sortie_detail', ['id' => $sortie->getId()]);
            }
        }

        return $this->render('sortie/add.html.twig', [
            'sortieForm' => $sortieForm->createView()
        ]);
    }
}
