<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Enterprises;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EnterprisesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($entr = 1; $entr <= 5; $entr++) {
            $enterprise = new Enterprises();
            $enterprise->setName($faker->text(10))
                ->setAddress($faker->streetAddress())
                ->setZipcode(str_replace(' ', '', $faker->postcode()))
                ->setCity($faker->city())
                ->setWebsite($faker->url())
                ->setContact($faker->name($gender = null | 'male' | 'female'))
                ->setContactFunction($faker->jobTitle())
                ->setPhoneNumber($faker->mobileNumber())
                ->setEmail($faker->email());

            $manager->persist($enterprise);

            $this->addReference('enterprise_' . $entr, $enterprise);
        }
        $manager->flush();
    }
}
