<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserFixture extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        try{

            $user = new User();

            $manager->persist($user);
            $user->setUsername('nevercodealone');
            $user->setUsernameCanonical('nevercodealone');
            $user->setEmail('member@nevercodealone.de');
            $user->setEmailCanonical('member@nevercodealone.de');
            $user->setEnabled(true);
            $user->setPlainPassword('nevercodealone');
            $user->setPassword('nevercodealone');
            $user->setRoles(array('ROLE_SUPER_ADMIN'));

            $manager->flush();
        }catch(\Throwable $exception){
            echo $exception->getMessage();
        }
    }
}
