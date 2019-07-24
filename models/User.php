<?php

namespace App\models;

/**
 * Class User
 * @package App\models
 * @method static getOne($id)
 * @method delete()
 */
class User extends Model
{
    public $id;
    public $user_name;
    public $user_login;
    public $user_password;
    public $user_last_action;

    protected static function getTableName()
    {
        return 'user';
    }

    public function getFullName()
    {
        return $this->user_name . '| ' . $this->user_login;
    }
}
