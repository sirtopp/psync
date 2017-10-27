<?php

namespace Stadnicki\Psync\Model;

/**
 * @author tstadnicki
 */
class User
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $email;

    /**
     * @var bool
     */
    public $disabled = false;

    /**
     * @var string[]
     */
    public $admin_roles = [];
    /**
     * @var string[]
     */
    public $admin_channels;

    /**
     * @var string[]
     */
    public $all_channels;

    /**
     * @var string[]
     */
    public $roles = [];
}