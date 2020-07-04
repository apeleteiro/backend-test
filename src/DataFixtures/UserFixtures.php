<?php

namespace App\DataFixtures;

use App\Entity\SearchRequest;
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
        $user->setUsername('antonio');
        $user->setEmail('antonio@peleteiro.eu');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'marketgoo'));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $searchRequest = new SearchRequest();
        $searchRequest->setCity('New York');
        $searchRequest->setDate(new \DateTime());
        $searchRequest->setUser($user);
        $manager->persist($searchRequest);

        $user = new User();
        $user->setUsername('jaime');
        $user->setEmail('jamie@marketgoo.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'marketgoo'));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $searchRequest = new SearchRequest();
        $searchRequest->setCity('Seattle');
        $searchRequest->setDate(new \DateTime());
        $searchRequest->setUser($user);
        $manager->persist($searchRequest);

        $searchRequest = new SearchRequest();
        $searchRequest->setCity('Boston');
        $searchRequest->setDate(new \DateTime());
        $searchRequest->setUser($user);
        $manager->persist($searchRequest);

        $manager->flush();
    }
}
