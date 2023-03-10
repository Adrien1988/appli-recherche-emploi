<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Users;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new Users();
        $admin->setEmail('admin@demo.fr');
        $admin->setLastName('Fauquembergue');
        $admin->setFirstName('Adrien');
        $admin->setAddress('4 allée des Bergeries');
        $admin->setZipcode('77170');
        $admin->setCity('Servon');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $faker = Faker\Factory::create('fr_FR');

        for ($usr = 1; $usr <= 5; $usr++) {
            $user = new Users();
            $user->setEmail($faker->email())
                ->setLastName($faker->lastName())
                ->setFirstname($faker->firstName())
                ->setAddress($faker->streetAddress())
                ->setZipcode(str_replace(' ', '', $faker->postcode))
                ->setCity($faker->city)
                ->setPassword(
                    $this->passwordEncoder->hashPassword($user, 'secredt')
                );

            $manager->persist($user);

            $this->addReference('user_'. $usr, $user);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
