<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user
            ->setUsername('fixture')
            ->setEmail('fixture@local.loc')
            ->setFirstName('Jane')
            ->setLastName('Doe')
            ->setRoles(['ROLE_USER'])
            ->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'fixturepassword'
            ))
        ;

        $manager->persist($user);

        $adminUser = new User();
        $adminUser
            ->setUsername('adminfixture')
            ->setEmail('adminfixture@local.loc')
            ->setFirstName('John')
            ->setLastName('Doe')
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
            ->setPassword($this->passwordEncoder->encodePassword(
                $adminUser,
                'fixturepassword'
            ))
        ;

        $manager->persist($adminUser);

        $manager->flush();
    }
}
