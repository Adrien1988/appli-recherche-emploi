<?php

namespace App\DataFixtures;

use App\Entity\Offers;
use Faker;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class OffersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($of = 1; $of <= 5; $of++) {
            $enterprise = $this->getReference('enterprise_' . $faker->numberBetween(1, 5));
            $offer = new Offers();
            $offer->setReference($faker->randomNumber(5, true))
                ->setJob($faker->word())
                ->setDescription($faker->text())
                ->setLink($faker->url())
                ->setEnterprises($enterprise);

            $manager->persist($offer);

            $this->addReference('offer_' . $of, $offer);
        }
        $manager->flush();
    }
}
