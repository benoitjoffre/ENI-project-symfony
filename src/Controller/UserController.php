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
     * @Route("/profil", name="user_profil")
     */
    public function edit(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(ProfilType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $password = $encoder->encodePassword($user, $user->getPassword());
$user->setPassword($password);
$manager->persist($user);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('login');
        }

        return $this->render("user/profil.html.twig", [
            "formInfo" => $form->createView()
        ]);

    }
}
