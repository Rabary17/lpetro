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
    /**
     * Constructor
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ReferencedPerson::class);
    }
}
