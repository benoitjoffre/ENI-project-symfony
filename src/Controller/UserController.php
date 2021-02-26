<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ProfilType;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;


class UserController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login()
    {
        return $this->render('user/login.html.twig');
    }

    /**
     * @Route("/profil", name="user_profil")
     * @param UserInterface $user
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function edit(UserInterface $user, Request $request, EntityManagerInterface $manager): Response
    {


            $form = $this->createForm(ProfilType::class, $user);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $manager->persist($user);
                $manager->flush();
                return $this->redirectToRoute('user_login',['id' => $user->getId()]);
            }

            return $this->render("user/profil.html.twig", [
                "formInfo" => $form->createView()
            ]);



    }
}   
