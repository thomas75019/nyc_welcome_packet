<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;


class UserFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
        $this->loadUsers($manager);

    }

    private function loadUsers(ObjectManager $manager)
    {
            $user = new User();

            $user->setEmail('thomas75019@gmail.com');
            $user->setRoles(['ROLE_SUPER_ADMIN']);
            //That password was for the test, I changed it
            $user->setPassword('$2y$13$4XWskwE.gO7RUj7vda6aSOyyEHKRXhj1UW9ibL91MWIXhFMcRUFoO ');


            $manager->persist($user);
            $manager->flush();
    }



}
