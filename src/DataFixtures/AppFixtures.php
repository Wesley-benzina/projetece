<?php

namespace App\DataFixtures;

use App\Entity\Client;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0;$i < 100;$i++){
            $client = (new Client())
                ->setEmail($faker->email)
                ->setCreatedAt($faker->dateTimeBetween('- 30 days'))
                ->setFirme("Entreprise test")
                ->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setPhone($faker->phoneNumber);
            $manager->persist($client);
        }

        for ($i = 0;$i < 10;$i++){
            $project = (new Project())
                ->setCreatedAt($faker->dateTimeBetween('- 30 days'))
                ->setName("Projet".$i)
                ->setProgress($faker->numberBetween(0,100))
                ->setClient($client)
                ->setState(true);

            $manager->persist($project);
        }

        $manager->flush();
    }
}
