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
    /**
     * Constructor
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ApplicationLetter::class);
    }
}
