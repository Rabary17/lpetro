<?php

namespace App\Repository;

use App\Entity\Overwrite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Overwrite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Overwrite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Overwrite[]    findAll()
 * @method Overwrite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OverwriteRepository extends ServiceEntityRepository
{
    /**
     * constructor
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Overwrite::class);
    }
}
