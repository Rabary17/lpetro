<?php

namespace App\Repository;

use App\Entity\School;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method School|null find($id, $lockMode = null, $lockVersion = null)
 * @method School|null findOneBy(array $criteria, array $orderBy = null)
 * @method School[]    findAll()
 * @method School[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchoolRepository extends ServiceEntityRepository
{
    /**
     * [__construct description]
     *
     * @param RegistryInterface $registry [description]
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, School::class);
    }
}
