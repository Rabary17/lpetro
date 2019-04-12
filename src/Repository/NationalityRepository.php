<?php

namespace App\Repository;

use App\Entity\Nationality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Nationality|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nationality|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nationality[]    findAll()
 * @method Nationality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NationalityRepository extends ServiceEntityRepository
{
    /**
     * [__construct description]
     *
     * @param RegistryInterface $registry [description]
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Nationality::class);
    }

    /**
     * [getAll description]
     * @return array [description]
     */
    public function getAll()
    {
        return $this->findBy(array(), array('nationality' => 'ASC'));
    }

    // /**
    //  * @return Nationality[] Returns an array of Nationality objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nationality
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
