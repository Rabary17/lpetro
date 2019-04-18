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
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TrainingLevel::class);
    }

    // /**
    //  * @return TrainingLevel[] Returns an array of TrainingLevel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TrainingLevel
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
