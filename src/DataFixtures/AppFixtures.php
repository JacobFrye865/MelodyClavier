<?php

namespace App\DataFixtures;

use App\Entity\Partitions;
use App\Entity\User;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct() 
    {
        $this->faker = Factory::create('fr_FR');
        
    }

    public function load(ObjectManager $manager): void
    {
       for ($i=0; $i < 5; $i++) { 
            $partitions = new Partitions();
            $partitions->setName($this->faker->words(3, true))
                       ->setDescription($this->faker->sentence());

            $manager->persist($partitions);
       }

        $manager->flush();
    }
}
