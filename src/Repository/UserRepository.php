<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{

    /**
     * Constructor
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

	/**
	 * @param string $role
	 *
	 * @return array
	 */
	public function fetchAllCandidates()
	{
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.seen = :seen')
            ->andWhere('u.enabled = :enabled')
            ->setParameter('roles', '%"'.$role.'"%')
            ->setParameter('seen', false )
            ->setParameter('enabled', true )
            ->getQuery()
            ->getArrayResult()
        ;
	}
}