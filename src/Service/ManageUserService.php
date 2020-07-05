<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ManageUserService
{
    private $manager;
    private $passwordEncoder;
    private $userRepository;

    public function __construct(EntityManagerInterface $manager, UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository)
    {
        $this->manager = $manager;
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
    }

    public function manageUser($authUser)
    {
        try {
            // FAKE DATA TO HANDLE USER SEARCHES
            $user = $this->userRepository->findOneBy(['username' => $authUser->getUsername()]);
            if (is_null($user)) {
                $user = new User();
                $user->setUsername($authUser->getUsername());
                $user->setEmail($authUser->getUsername() . '@gmail.com');
                $user->setPassword($this->passwordEncoder->encodePassword($user, 'marketgoo'));
                $user->setRoles(['ROLE_USER']);
                $this->manager->persist($user);
                $this->manager->flush();
            }

            return $user;
        } catch (\Exception $exception) {
            return new User();

        }
    }
}
