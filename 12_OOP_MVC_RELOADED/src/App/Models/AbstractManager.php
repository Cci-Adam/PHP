<?php
namespace App\Models;

abstract class AbstractManager
{
    protected static $db;
    protected static $tableName;
    protected static $obj;

    public function getAll($nb = null,$query=null): array|false
    {
        $limit = !is_null($nb) ? " LIMIT $nb " : "";
        $sql_query = !is_null($query) ? $query : "SELECT * FROM ".self::$tableName;
        $results = [];
        $results = self::$db->selectAll($sql_query.$limit);
        return $results;
    }

    public function getOneById($id = null,$query=null): array|false
    {
        $sql_query = !is_null($query) ? $query : "SELECT * FROM ".self::$tableName." WHERE id = $id";
        $results = [];
        $results = self::$db->select($sql_query);
        return $results;
    }

    public function update($query): void
    {
        self::$db->query($query);
    }

    public function insert($data = [])
    {
        $fields = self::$obj->getAttributes();
        foreach ($fields as $field){
            $values[] = "'" . $data[$field] . "'";
        }
        $str_fields = implode(",",$fields);
        $str_values = implode(",",$values);
        $insert = self::$db->query("INSERT INTO ".self::$tableName." ($str_fields) VALUES ($str_values)",$data);
        return $insert;
    }
}