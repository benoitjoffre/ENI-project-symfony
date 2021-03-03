<?php

namespace App\DataFixtures;
use App\Entity\Campus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CampusFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
            $campus1 = new Campus();
            $campus1->setNom("En Ligne");
            $manager->persist($campus1);

            $campus2 = new Campus();
            $campus2->setNom("Nantes");
            $manager->persist($campus2);

            $campus3 = new Campus();
            $campus3->setNom("Niort");
            $manager->persist($campus3);

            $manager->flush();
    }
}
