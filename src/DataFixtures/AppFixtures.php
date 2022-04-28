<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\User;
use App\Enum\UserRole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {

    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('user@carbooking.com');
        $user->setRoles([UserRole::ROLE_USER]);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, 'user'));
        $manager->persist($user);

        $user = new User();
        $user->setEmail('admin@carbooking.com');
        $user->setRoles([UserRole::ROLE_ADMIN]);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, 'admin'));
        $manager->persist($user);

        foreach (range(0, 10) as $i) {
            $car = new Car();
            $car->setName('Seat Ibiza ' . $i);
            $car->setFuelType('diesel');
            $manager->persist($car);
        }

        $manager->flush();
    }
}
