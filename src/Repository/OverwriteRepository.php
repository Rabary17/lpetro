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
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Overwrite::class);
    }

    // /**
    //  * @return Overwrite[] Returns an array of Overwrite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Overwrite
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
