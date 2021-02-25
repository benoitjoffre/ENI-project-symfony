<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ProfilType;
use App\Entity\User;


class UserController extends AbstractController
{
    /**
     * @Route("/login", name="user_login")
     */
    public function login()
    {
        return $this->render('user/login.html.twig');
    }

 /**
     * @Route("/profil", name="user_profil")
     */
    public function form(Profil $profil= null , Request $request, EntityManagerInterface $manager){
         
        if(!$profil){
            $profil= new Profil();
        }

             $form = $this->createForm(ProfilType::class, $profil);

                $form->handleRequest($request);

                if($form->isSubmitted() && $form->isValid()){
                    $profil->getId();
                }

                    $manager->persist($profil);

                    $manager->flush();

                    return $this->redirectToRoute('user_login',['id' => $profil->getId()]);
                
    
}
}   
