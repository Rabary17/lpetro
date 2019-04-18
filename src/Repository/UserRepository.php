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
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @return array
     */
    public function fetchAllRecentCandidates()
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.seen = :seen')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('seen', false)
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->orderBy('u.firstName', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @return array
     */
    public function fetchAllCandidates()
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->orderBy('u.firstName', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param string $id description
     * @return array
     */
    public function fetchByUser($id)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.id = :id')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->setParameter('id', $id)
            ->orderBy('u.firstName', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param  integer   $rhvalidate  description
     * @param  integer   $status      description
     * @param  integer   $nationality description
     * @param  integer[] $tags        description
     * @return array
     */
    public function filterCandidat($rhvalidate = '', $status = null, $nationality = null, $tags = [])
    {
        $role = 'ROLE_CANDIDAT';

        $qb = $this->createQueryBuilder('u')
            ->join('u.tags', 't')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled');

        if ($rhvalidate == true) {
            $qb->andWhere('u.rhvalidate = :rhvalidate')
                ->setParameter('rhvalidate', true);
        }

        if ($status) {
            $qb->andWhere('u.statut = :status')
               ->setParameter('status', $status);
        }

        if ($nationality) {
            $qb->andWhere('u.nationality = :nationality')
               ->setParameter('nationality', $nationality);
        }

        if ($tags) {
            $qb->andWhere('t.id IN (:tags)')
               ->setParameter('tags', $tags);
        }

        $qb->setParameter('roles', '%"' . $role . '"%')
           ->setParameter('submit', true)
           ->setParameter('enabled', true);
        $qb->orderBy('u.firstName', 'ASC');
        $query = $qb->getQuery();
        $result = $query->getArrayResult();

        return $result;
    }

    /**
     * @param string $q description
     * @return array
     */
    public function fetchFilteredCandidates($q)
    {
        $role = 'ROLE_CANDIDAT';

        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :roles')
            ->andWhere('u.submit = :submit')
            ->andWhere('u.enabled = :enabled')
            ->andWhere('u.lastName LIKE :lastName')
            ->orWhere('u.firstName LIKE :firstName')
            ->orWhere('u.username LIKE :username')
            ->setParameter('roles', '%"' . $role . '"%')
            ->setParameter('lastName', '%' . $q . '%')
            ->setParameter('firstName', '%' . $q . '%')
            ->setParameter('username', '%' . $q . '%')
            ->setParameter('submit', true)
            ->setParameter('enabled', true)
            ->orderBy('u.firstName', 'ASC')
            ->getQuery()
            ->getArrayResult();
    }
}
