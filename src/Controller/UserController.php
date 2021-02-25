<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
<<<<<<< HEAD
use Symfony\Component\Routing\Annotation\Route;
=======
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ProfilType;
use Symfony\Component\Security\Core\User\UserInterface;

>>>>>>> 6379409c72bb755b0dd5d31490a78490b1c2be5e

class UserController extends AbstractController
{
    /**
<<<<<<< HEAD
     * @Route("/login", name="login")
=======
     * @Route("/login", name="user_login")
>>>>>>> 6379409c72bb755b0dd5d31490a78490b1c2be5e
     */
    public function login()
    {
        return $this->render('user/login.html.twig');
    }

    /**
<<<<<<< HEAD
     * @Route("logout", name="logout")
     */
    public function logout(){
    }
}
=======
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
>>>>>>> 6379409c72bb755b0dd5d31490a78490b1c2be5e
