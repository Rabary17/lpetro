<?php

namespace App\Repository;

use App\Entity\TrainingResult;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TrainingResult|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrainingResult|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrainingResult[]    findAll()
 * @method TrainingResult[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrainingResultRepository extends ServiceEntityRepository
{
    /**
     * [__construct description]
     *
     * @param RegistryInterface $registry [description]
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TrainingResult::class);
    }
}
