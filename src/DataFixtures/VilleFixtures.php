<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ville;

class VilleFixtures extends Fixture
{
    protected $faker;

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create('fr_FR');

        for($i=1 ; $i <= 5; $i++){
            $ville = new Ville();
            $ville->setNom($this->faker->city);
            $ville->setCodePostal(12345);
            $manager->persist($ville);
        }

        $manager->flush();
    }
}
