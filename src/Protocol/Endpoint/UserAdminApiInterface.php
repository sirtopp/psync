<?php

namespace Stadnicki\Psync\Protocol\Endpoint;

use Stadnicki\Psync\Model\User;
use Stadnicki\Psync\Protocol\OperationResult;

/**
 * @author tstadnicki
 */
interface UserAdminApiInterface
{
    /**
     * @return User[]
     */
    public function getUsers();

    /**
     * @param User $user
     * @return OperationResult
     */
    public function createUser(User $user);

    /**
     * @param $userName
     * @return User
     */
    public function getUser($userName);

    /**
     * @param User $user
     * @return OperationResult
     */
    public function upsertUser(User $user);

    /**
     * @param User $user
     * @return OperationResult
     */
    public function deleteUser(User $user);
}