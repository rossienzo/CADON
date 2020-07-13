<?php

namespace App\Models;

use Src\Database\Connection;

class Task
{
    private $idtask;
    private $iduser;
    private $idstatus;
    private $destask;

    public function __set($attrib, $value)
    {
        return $this->$attrib = $value;
    }

    public function __get($attrib)
    {
        return $this->$attrib;
    }

    public function select()
    {
        $sql = 'SELECT a.idtask, b.status, a.destask, DATE_FORMAT(a.dtregistertask,"%d-%m-%Y %H:%i:%s") as dtregistertask  FROM tb_tasks as a
        CROSS JOIN tb_taskstatus as b ON a.idstatus = b.idstatus
        WHERE iduser = :IDUSER';

        $iduser = $this->__get('iduser');       
     
        $conn = Connection::open('config');        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':IDUSER', $iduser);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);;
    }

    public function selectStatus($status)
    {
        $sql = 'SELECT a.idtask, b.status, a.destask, a.dtregistertask FROM tb_tasks as a
        CROSS JOIN tb_taskstatus as b ON a.idstatus = b.idstatus
        WHERE iduser = :IDUSER && b.status = :STATUS';

        $iduser = $this->__get('iduser');       
     
        $conn = Connection::open('config');        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':IDUSER', $iduser);
        $stmt->bindParam(':STATUS', $status);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);;
    }

    public function insert()
    {
        $sql = 'INSERT INTO tb_tasks (iduser, idstatus, destask)
                VALUES (:IDUSER, :IDSTATUS, :IDTASKS)';

        $iduser = $this->__get('iduser');       
        $idstatus = $this->__get('idstatus');       
        $destask = $this->__get('destask');       

        $conn = Connection::open('config');        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':IDUSER', $iduser);
        $stmt->bindParam(':IDSTATUS', $idstatus);
        $stmt->bindParam(':IDTASKS', $destask);
        $stmt->execute();
    }

    public function updateIndex($column, $index)
    {
        $sql = "UPDATE tb_tasks SET $column = :INDEX
                WHERE idtask = :IDTASK && iduser = :IDUSER";

        $iduser = $this->__get('iduser');       
        $idtask = $this->__get('idtask');

        $conn = Connection::open('config');        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':INDEX', $index);
        $stmt->bindParam(':IDTASK', $idtask);
        $stmt->bindParam(':IDUSER', $iduser);
        
        $stmt->execute();
    }
    
    public function delete()
    {
        $sql = 'DELETE FROM tb_tasks 
                WHERE iduser = :IDUSER && idtask = :IDTASK';

        $idtask = $this->__get('idtask');
        $iduser = $this->__get('iduser');       
               
        $conn = Connection::open('config');        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':IDTASK', $idtask);
        $stmt->bindParam(':IDUSER', $iduser);
        $stmt->execute();

    }
}