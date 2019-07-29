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
    public $date;
    public $user_last_action;

    public function getFullName()
    {
        return $this->login . '| ' . $this->fio;
    }
}
