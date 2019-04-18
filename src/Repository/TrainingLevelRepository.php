<?php

namespace App\Repository;

use App\Entity\TrainingLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TrainingLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainingLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainingLevel[]    findAll()
 * @method TrainingLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingLevelRepository extends ServiceEntityRepository
{
    /**
     * [__construct description]
     * @param RegistryInterface $registry [description]
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TrainingLevel::class);
    }
}
