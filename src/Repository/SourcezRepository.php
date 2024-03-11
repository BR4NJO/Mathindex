<?php

namespace App\Repository;

use App\Entity\Sourcez;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sourcez>
 *
 * @method Sourcez|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sourcez|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sourcez[]    findAll()
 * @method Sourcez[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SourcezRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sourcez::class);
    }

//    /**
//     * @return Sourcez[] Returns an array of Sourcez objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Sourcez
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
