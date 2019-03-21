<?php

namespace App\Repository;

use App\Entity\ExtraWorkActivity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExtraWorkActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExtraWorkActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExtraWorkActivity[]    findAll()
 * @method ExtraWorkActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExtraWorkActivityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExtraWorkActivity::class);
    }

//    /**
//     * @return ExtraWorkActivity[] Returns an array of ExtraWorkActivity objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExtraWorkActivity
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
