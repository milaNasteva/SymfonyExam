<?php
namespace App\Repository;

use App\Entity\ExampleEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ExampleEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExampleEntity::class);
    }

    // Example method to find all entities
    public function findAllExampleEntities()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    // Example method to find an entity by ID
    public function findExampleEntityById($id)
    {
        return $this->createQueryBuilder('e')
            ->where('e.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    // Example method to save or update an entity
    public function saveExampleEntity(ExampleEntity $entity)
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    // Example method to delete an entity
    public function deleteExampleEntity(ExampleEntity $entity)
    {
        $this->_em->remove($entity);
        $this->_em->flush();
    }

    // Add more methods as needed for specific queries or operations
}