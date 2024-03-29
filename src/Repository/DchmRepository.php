<?php

namespace App\Repository;

use App\Entity\Dchm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dchm|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dchm|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dchm[]    findAll()
 * @method Dchm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DchmRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dchm::class);
    }

    // /**
    //  * @return Dchm[] Returns an array of Dchm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dchm
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
