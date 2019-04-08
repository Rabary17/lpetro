<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends BaseAdminController
{
    private $passwordEncoder;

    /**
     * [__construct description]
     * @param UserPasswordEncoderInterface $passwordEncoder [description]
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * [persistEntity description]
     * @param string $entity [description]
     * @return void [description]
     */
    public function persistEntity($entity)
    {
        $this->encodePassword($entity);
        parent::persistEntity($entity);
    }

    /**
     * [updateEntity description]
     * @param string $entity [description]
     * @return void         [description]
     */
    public function updateEntity($entity)
    {
        $this->encodePassword($entity);
        parent::updateEntity($entity);
    }

    /**
     * [encodePassword description]
     * @param  User $user [description]
     * @return void       [description]
     */
    public function encodePassword($user)
    {
        if (!$user instanceof User) {
            return;
        }

        $user->setPassword(
            $this->passwordEncoder->encodePassword($user, $user->getPassword())
        );
    }
}
