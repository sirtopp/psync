<?php

namespace Stadnicki\Psync\Protocol\Endpoint;

use Stadnicki\Psync\Model\User;
use Stadnicki\Psync\Protocol\AbstractApi;
use Stadnicki\Psync\Protocol\OperationResult;

/**
 * @author tstadnicki
 */
class UserApi
    extends AbstractApi
    implements UserAdminApiInterface
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
        $this->sendPostRequest('/_user/', $user);
    }

    /**
     * @param $userName
     * @return User
     */
    public function getUser($userName)
    {
        $obj = $this->sendGetRequest('/_user/' . $userName);

        return $this->objToClass($obj, new User());
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