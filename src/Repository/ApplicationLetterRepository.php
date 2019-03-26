<?php

namespace App\Repository;

use App\Entity\ApplicationLetter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ApplicationLetter|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApplicationLetter|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApplicationLetter[]    findAll()
 * @method ApplicationLetter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationLetterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ApplicationLetter::class);
    }

//    /**
//     * @return ApplicationLetter[] Returns an array of ApplicationLetter objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ApplicationLetter
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
