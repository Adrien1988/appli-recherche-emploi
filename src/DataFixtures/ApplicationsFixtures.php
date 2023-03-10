<?php

namespace App\DataFixtures;

use App\Entity\Applications;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker;

class ApplicationsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($app = 1; $app <= 5; $app++) {
            $user = $this->getReference('user_' . $faker->numberBetween(1, 5));
            $offer = $this->getReference('offer_' . $faker->numberBetween(1, 5));
            $result = $this->getReference('result_' . $faker->numberBetween(1, 5));
            $application = new Applications();
            $application->setSendingDate($faker->dateTimeBetween('-1 month', '+1 month'))
                ->setSendMode($faker->word())
                ->setType($faker->word())
                ->setReleaseDate($faker->dateTimeBetween('-1 month', '+1 month'))
                ->setSupport($faker->word())
                ->setCurriculum($faker->mimeType())
                ->setCoverLetter($faker->mimeType())
                ->setUsers($user)
                ->setOffers($offer)
                ->setResults($result);
            $manager->persist($application);

            $this->setReference('application_'. $app, $application);
        }

        $manager->flush();
    }
}
