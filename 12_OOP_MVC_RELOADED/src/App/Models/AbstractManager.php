<?php
namespace App\Models;

abstract class AbstractManager
{
    protected static $db = null;
    protected static $tableName = null;
    protected static $obj = null;

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

    public function update($query,$data = []): void
    {
        self::$db->query($query,$data);
    }

    public function insert($data = [])
    {
        $fields = self::$obj->getAttributes();
        foreach ($fields as $field){
            $values[] = "?";
        }
        $str_fields = implode(",",$fields);
        $str_values = implode(",",$values);
        $query = "INSERT INTO ".self::$tableName." ($str_fields) VALUES ($str_values)";
        var_dump($query);
        $insert = self::$db->query($query,$data);
        return $insert;
    }

    public function delete($id,$query = null): void
    {
        $sql_query = !is_null($query) ? $query : "DELETE FROM ".self::$tableName." WHERE id = $id";
        
        self::$db->query($sql_query);
    }
}