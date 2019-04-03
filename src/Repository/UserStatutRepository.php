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
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserStatut::class);
    }

    // /**
    //  * @return UserStatut[] Returns an array of UserStatut objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserStatut
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
