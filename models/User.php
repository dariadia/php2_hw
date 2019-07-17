<?php

namespace App\models;

class User extends Model
{
    public $id;
    public $name;
    public $login;
    public $password;

    protected function getTableName()
    {
        return 'user';
    }


    public function getProperties()
    {
        $properties = [];
        foreach ($this as $key => $value) {
            $properties[] = $key;
        }
        var_dump($properties);
    }
}
