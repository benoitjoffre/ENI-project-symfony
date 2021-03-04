<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * @Route("logout", name="logout")
     */
    public function logout(){
    }


    /**
     * @Route("/profil", name="user_profil")
     * @param UserInterface $user
     */
    public function profil(UserInterface $user)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_REMEMBERED");

        return $this->render("user/profil/profil.html.twig", [
            "user" => $user
        ]);

    }

    /**
     * @Route("/profil/edit", name="user_profil_edit")
     * @param UserInterface $user
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(UserInterface $user, Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_REMEMBERED");
        $form = $this->createForm(ProfilType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('success', 'Votre profil a bien été modifié !');
            return $this->redirectToRoute('home');
        }

        return $this->render("user/profil/edit.html.twig", [
            "formInfo" => $form->createView()
        ]);

    }
}
