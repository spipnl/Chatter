<?php
namespace Chatter\Service;
use Chatter\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * User Service
 */
class UserService
{
    /**
     * @var null|EntityManager
     */
    protected $entityManager = null;

    /**
     * @var null|EntityRepository
     */
    protected $repository = null;

    public function setRepository(EntityRepository $repository)
    {
        $this->repository = $repository;

        return $this;
    }

    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        return $this;
    }

    public function getAllUsers()
    {
        $users = $this->repository->findAll();

        return $users;
    }

    public function getUserById($userId)
    {
        /** @var User $user */
        $user = $this->repository->find($userId);

        return $user;
    }
}