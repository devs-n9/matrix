<?php

namespace Matrix;

use Matrix\Database\AbstractDB;

class Model extends AbstractDB
{
    protected $table = '';

    public function all()
    {
        $result = $this->db->prepare("SELECT * FROM {$this->table}");
        $result->execute();
        $result->setFetchMode(\PDO::FETCH_CLASS, get_called_class());

        return $result->fetchAll();
    }

    public function find($id)
    {
        $result = $this->db->prepare("SELECT * FROM {$this->table} WHERE id=?");
        $result->execute([$id]);
        
        $result->setFetchMode(\PDO::FETCH_CLASS, get_called_class());

        return $result->fetch();
    }

    public function create($data)
    {
        $fields = implode(", ", array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));
        $result = $this->db->prepare("INSERT INTO {$this->table} ($fields) VALUES ($values)");
        
        $result->execute(array_values($data));
        
        return $this->find($this->db->lastInsertId());
    }

    public function update($id, $data)
    {
        $params = '';
        
        foreach($data as $k => $v){
            $params .= $k . '= ?, '; 
        }
        
        $params = substr($params, 0, -2);
        
        $result = $this->db->prepare("UPDATE {$this->table} SET {$params} WHERE id=? ");
        
        $data[] = $id;
        
        $result->execute(array_values($data));
        
        return $this->find($id);
    }

    public function delete($id)
    {
        if(!empty($id)){
            $result = $this->db->prepare("DELETE FROM {$this->table} WHERE id= ?");
            $result->execute([$id]);
            
            return $id;
        }else{
            return false;
        }
    }
}