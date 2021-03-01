<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for($i=1 ; $i <=10; $i++){
            $user = new User();
            $user->setUsername("Pseudo");
            
            $manager->persist($user);
        }

        $manager->flush();
    }
}
