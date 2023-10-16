<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\BookRent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BookRent>
 *
 * @method BookRent|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookRent|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookRent[]    findAll()
 * @method BookRent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookRent::class);
    }
    public function getAll():array{
        $conn = $this->getEntityManager()->getConnection();


        return  $this->findAll();
        // returns an array of arrays (i.e. a raw data set)

    }
    public function add(BookRent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BookRent $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


//    /**
//     * @return BookRent[] Returns an array of BookRent objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BookRent
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
