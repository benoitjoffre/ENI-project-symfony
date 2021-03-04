<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @Route("/account/{id}", name="user_account",
     * requirements={"id": "\d+"},
     * methods={"GET"})
     */
    public function profil($id, Request $request)
    {
        //$this->denyAccessUnlessGranted("ROLE_USER");
        $profilRepo = $this->getDoctrine()->getRepository(User::class);
        $user = $profilRepo->find($id);

        return $this->render('user/account.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/account/{id}/modifier", name="user_profil")
     */
    public function edit(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_REMEMBERED");
        $user = $this->getUser();
        $form = $this->createForm(ProfilType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $password = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $manager->persist($user);
            $manager->flush();
            $this->addFlash("success", "Your account has been updated!");
            return $this->redirectToRoute('user_account');
        }

        return $this->render("user/profil.html.twig", [
            "formInfo" => $form->createView(),
            "user" => $user
        ]);

    }
}

