<?php

namespace App\Repository;

use App\Entity\UserStatut;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserStatut|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserStatut|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserStatut[]    findAll()
 * @method UserStatut[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserStatutRepository extends ServiceEntityRepository
{
    /**
     * [__construct description]
     * @param RegistryInterface $registry [description]
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserStatut::class);
    }
}
