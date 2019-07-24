<?php
namespace App\models;
/**
 * Class Good
 * @package App\models
 * @method static getOne($id)
 */
class Good extends Model
{
    public $id;
    public $price;
    public $name;
    public $info;

    protected static function getTableName()
    {
        return 'goods';
    }
}