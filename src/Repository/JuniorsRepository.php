<?php

namespace App\Repository;

use App\Entity\Juniors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Juniors|null find($id, $lockMode = null, $lockVersion = null)
 * @method Juniors|null findOneBy(array $criteria, array $orderBy = null)
 * @method Juniors[]    findAll()
 * @method Juniors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JuniorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Juniors::class);
    }

    // /**
    //  * @return Juniors[] Returns an array of Juniors objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Juniors
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
