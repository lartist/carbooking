<?php

namespace App\Repository;

use App\Entity\CarBooking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarBooking>
 *
 * @method CarBooking|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarBooking|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarBooking[]    findAll()
 * @method CarBooking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarBookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarBooking::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CarBooking $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(CarBooking $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return CarBooking[] Returns an array of CarBooking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CarBooking
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
