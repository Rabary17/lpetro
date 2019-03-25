<?php

namespace App\Repository;

use App\Entity\ReferencedPerson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ReferencedPerson|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReferencedPerson|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReferencedPerson[]    findAll()
 * @method ReferencedPerson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReferencedPersonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ReferencedPerson::class);
    }

//    /**
//     * @return ReferencedPerson[] Returns an array of ReferencedPerson objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReferencedPerson
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
