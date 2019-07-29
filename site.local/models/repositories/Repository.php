<?php

namespace App\models\repositories;

use App\models\entities\Entity;
use App\services\BD;

/**
 * Class Model
 * @package App\models
 *
 * @property int $id
 */
abstract class Repository
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

    abstract protected function getEntityName();

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
        return $this->bd->queryObject(
            $sql,
            $this->getEntityName(),
            [':id' => $id]
        );
    }

    /**
     * Получение всех записей таблицы
     * @return mixed
     */
    public  function getAll()
    {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM products.{$tableName} ";
        return $this->bd->queryObjects($sql, $this->getEntityName());
    }
    //INSERT INTO users(fio, login, password) VALUES (:fio, :login, :password)

    protected function insert()
    {
        $columns = [];
        $params = [];

        foreach ($this as $key => $value) {
            if ($key == 'bd') {
                continue;
            }
            $columns[] = $key;
            $params[":{$key}"] = $value;
        }

        $columnsString = implode(', ', $columns);
        $placeholders = implode(', ', array_keys($params));
        $tableName = $this->getTableName();
        $sql = "INSERT INTO products.{$tableName} ({$columnsString})
          VALUES ({$placeholders})";
        $this->bd->execute($sql, $params);
        $this->id = $this->bd->lastInsertId();
    }

    protected function update($entity)
    {
        $columns = [];
        $params = [];
        foreach ($this as $key => $value) {
            if ($key == 'bd') {
                continue;
            }
            $columns[] = $key;
            $params[] = $value;
        }
        $stringSet = ' ';
        for ($i = 1; $i < count($params); $i++) {
            $stringSet .= $columns[$i] . ' = ' . $params[$i];
            if ($i < count($params) - 1) {
                $stringSet .= ', ';
            }
        }
        $tableName = $this->getTableName();
        $sql = "UPDATE products.{$tableName} SET $stringSet WHERE id =:id";
        $this->bd->execute($sql, [':id' => $entity->id]);
    }

    public function save($entity)
    {
        if (empty($this->id)) {
            $this->insert();
            return;
        }
        $this->update($entity);
        return;
    }

    public function delete(Entity $entity)
    {
        $tableName = $this->getTableName();
        
        $sql = "DELETE FROM products.{$tableName} WHERE id = :id ";
        $this->bd->execute($sql, [':id' => $entity->id]);
    }
}
