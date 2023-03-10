<?php

namespace App\DataFixtures;

use App\Entity\Results;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker;




class ResultsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($res = 1; $res <= 5; $res++) {
            $result = new Results();
            $result->setAnswer($faker->text())
            ->setComment($faker->text());

            $this->setReference('result_'. $res, $result);
            $manager->persist($result);
        }

        $manager->flush();
    }
}
