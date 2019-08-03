<?php

namespace App\models\entities;

/**
 * Class User
 * @package App\models\entities
 */
class User extends Entity
{
    public $id;
    public $user_name;
    public $user_login;
    public $user_password;
    public $user_last_action;
    public $user_order;
    public $user_credit_card;
    public $user_address;

    public function getFullName()
    {
        return $this->user_name . '| ' . $this->user_login;
    }
}
