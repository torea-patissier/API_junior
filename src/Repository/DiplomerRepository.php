<?php

namespace App\Repository;

use App\Entity\Diplomer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Diplomer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Diplomer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Diplomer[]    findAll()
 * @method Diplomer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiplomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Diplomer::class);
    }

    // /**
    //  * @return Diplomer[] Returns an array of Diplomer objects
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
    public function findOneBySomeField($value): ?Diplomer
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
