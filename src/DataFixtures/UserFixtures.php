<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
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
        $this->loadUsers($manager);

    }

    private function loadUsers(ObjectManager $manager)
    {
            $user = new User();

            $user->setEmail('thomas75019@gmail.com');
            $user->setRoles(['ROLE_SUPER_ADMIN']);
            $user->setPassword('$2y$13$y4/GQ/Na4nkkPp0oaXXBTOydjRTsTHwz3HXnyCwawSK88nVxDWfgm');


            $manager->persist($user);
            $manager->flush();
    }



}
