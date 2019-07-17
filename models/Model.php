<?php

namespace App\models;

use App\services\BD;
use App\services\IBD;

abstract class Model
{
    /**
     * @var BD Класс для работы с базой данных
     */
    protected $bd;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->bd = BD::getInstance();
    }

    /**
     * Данный метод должен вернуть название таблицы
     * @return string
     */
    abstract protected function getTableName();

    /**
     * Возращает запись с указанным id
     *
     * @param int $id ID Записи таблицы
     * @return array
     */
    public function getOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM products.{$tableName} WHERE id = :id";
        return $this->bd->find($sql, [':id' => $id]);
    }

    /**
     * Получение всех записей таблицы
     * @return mixed
     */
    public function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM products.{$tableName} ";
        return $this->bd->findAll($sql);
    }


    /**
     * Удаляет запись с указанным id
     * @param int $id ID Записи таблицы
     * @return array
     */
    public function deleteOne($id)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM products.{$tableName} WHERE id = :id";
        return $this->bd->execute($sql, [':id' => $id]);
    }

    /**
     * Добавляет запись в товары
     * @return array
     */
    public function insertGood($good_name, $good_description, $good_price, $is_active, $src)
    {
        $sql = "INSERT INTO products.goods ( good_name, good_description, good_price, is_active, src ) VALUES ( :good_name, :good_description, :good_price, :is_active, :src )";
        return $this->bd->execute($sql, [':good_name' => $good_name, ':good_description' => $good_description, ':good_price' => $good_price, ':is_active' => $is_active, ':src' => $src,]);
    }

    /**
     * Добавляет запись в юзеры
     * @return array
     */
    public function insertUser($user_name, $user_login, $user_password, $user_last_action)
    {
        $user_password = password_hash($user_password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO products.user ( user_name, user_login, user_password, user_last_action ) VALUES ( :user_name, :user_login, :user_password, :user_last_action )";
        return $this->bd->execute($sql, [':user_name' => $user_name, ':user_login' => $user_login, ':user_password' => $user_password, ':user_last_action' => $user_last_action]);
    }

    /**
     * Обновляет запись с указанным id
     * @param int $id ID Записи таблицы
     * @return array
     */
    public function updateOne($id, $column, $element)
    {
        $tableName = $this->getTableName();
        $sql = "UPDATE products.{$tableName} SET $column = $element WHERE id = :id";
        return $this->bd->execute($sql, [':id' => $id]);
    }

    /**
     * сохраняет данные, в таблице или обновляет, или добавляет
    */
    public function save(){
        // wohooo magic
    }
}
