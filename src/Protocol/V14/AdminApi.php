<?php

use Stadnicki\Psync\Model\User;
use Stadnicki\Psync\Protocol\AdminAdminApiInterface;
use Stadnicki\Psync\Protocol\OperationResult;


/**
 * <put short description here>
 *
 * @author tstadnicki
 */
class AdminApi
    implements AdminAdminApiInterface
{
    /**
     * @return User[]
     */
    public function getUsers()
    {
        // TODO: Implement getUsers() method.
    }

    /**
     * @param User $user
     * @return OperationResult
     */
    public function createUser(User $user)
    {
        // TODO: Implement createUser() method.
    }

    /**
     * @param $userName
     * @return User
     */
    public function getUser($userName)
    {
    }

    /**
     * @param User $user
     * @return OperationResult
     */
    public function upsertUser(User $user)
    {
        // TODO: Implement upsertUser() method.
    }

    /**
     * @param User $user
     * @return OperationResult
     */
    public function deleteUser(User $user)
    {
        // TODO: Implement deleteUser() method.
    }
}