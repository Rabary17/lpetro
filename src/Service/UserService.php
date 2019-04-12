<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserService
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * Constructor
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * cvViewed
     *
     * @param  string $id [description]
     * @return array
     */
    public function cvViewed($id)
    {
        $candidat = $this->em->getRepository('App:User')->find($id);
        $candidat->setSeen(1);
        $this->em->flush();

        return $candidat;
    }

    /**
     * cvRhValidate
     *
     * @param  string $id [description]
     * @return array
     */
    public function cvRhValidate($id)
    {
        $candidat = $this->em->getRepository('App:User')->find($id);
        $candidat->setrhValidate(1);
        $this->em->flush();

        return $candidat;
    }

    /**
     * cvStatut
     *
     * @param  string $id       [description]
     * @param  string $idstatut [description]
     * @return array
     */
    public function cvStatut($id, $idstatut)
    {
        $candidat = $this->em->getRepository('App:User')->find($id);
        $candidat->setStatut($idstatut);
        $this->em->flush();

        return $candidat;
    }

    /**
     * cvArchived
     *
     * @param  string $id [description]
     * @return array
     */
    public function cvArchived($id)
    {
        $candidat = $this->em->getRepository('App:User')->find($id);
        $candidat->setArchived(1);
        $this->em->flush();

        return $candidat;
    }
}
