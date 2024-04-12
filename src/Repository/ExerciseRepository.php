<?php

namespace App\Repository;

use App\Entity\Exercise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Exercise>
 *
 * @method Exercise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Exercise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Exercise[]    findAll()
 * @method Exercise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExerciseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Exercise::class);
    }
    
    public function paginate(int $page, int $itemsPerPage): array
    {
        return $this->createQueryBuilder('p')
            ->setFirstResult(($page -1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage)
            ->getQuery()
            ->execute();
    }

    public function search(Exercise $exercice): array
    {
        $queryBuilder = $this->createQueryBuilder('e')
            ->Join('e.classroom', 'c')
            ->Join('e.thematic', 't')
            ->where('c.id = :classroom')
            ->andWhere('t.id = :thematic')
            ->andWhere('e.keywords LIKE :keywords')
            ->setParameter('classroom', $exercice->getClassroom())
            ->setParameter('thematic', $exercice->getThematic())
            ->setParameter('keywords', '%'.$exercice->getKeywords().'%');

        return $queryBuilder->getQuery()->getResult();
    }
}
