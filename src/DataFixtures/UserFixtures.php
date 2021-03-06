<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $encoder;
    private $faker;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();
        for($i=1 ; $i <=10; $i++){
            $user = new User();
            $user->setUsername("pseudo".$i);
            $user->setPrenom("prenom".$i);
            $user->setNom("nom".$i);
            $user->setTel("0123456789");
            $user->setEmail("pseudo".$i."@sortir.com");
            $password = $this->encoder->encodePassword($user, 'pass4dev');
            $user->setPassword($password);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
