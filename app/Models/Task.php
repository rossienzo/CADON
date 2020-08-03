<?php

namespace App\Models;

use PDOException;
use Src\Application\Model;
use Src\Database\Sql;

class Task extends Model
{
    private $idtask;
    private $iduser;
    private $idstatus;
    private $destask;

    /**
     * seleciona todas as tarefas relacionados ao status passado
     * @param status por padrão recebe o valor
     * 'all' = retorna todas as tarefas;
     * 'pendente' = retorna todas as tarefas pendentes;
     * 'realizado' = retorna todas as tarefas realizadas;
     */
    public function selectStatus($status = 'all')
    {
        $iduser = $this->__get('iduser');

        if($status === 'all') // retorna todas as tarefas
        {
            $sql = 'SELECT a.idtask, b.status, a.destask, DATE_FORMAT(a.dtregistertask,"%d-%m-%Y %H:%i:%s") as dtregistertask  FROM tb_tasks as a
                    CROSS JOIN tb_taskstatus as b ON a.idstatus = b.idstatus
                    WHERE iduser = :IDUSER';
            
            $params = array(
                ':IDUSER'=> $iduser,
            );
        } 
        else
        {
            $sql = 'SELECT a.idtask, b.status, a.destask, DATE_FORMAT(a.dtregistertask,"%d-%m-%Y %H:%i:%s") as dtregistertask FROM tb_tasks as a
                    CROSS JOIN tb_taskstatus as b ON a.idstatus = b.idstatus
                    WHERE iduser = :IDUSER && b.status = :STATUS';

            $params = array(
                ':IDUSER'=> $iduser,
                ':STATUS'=> $status
            );
        }       
    
        $conn = new Sql();
        return $conn->select($sql, $params);
    }

    public function insert()
    {
        $sql = 'INSERT INTO tb_tasks (iduser, idstatus, destask)
                VALUES (:IDUSER, :IDSTATUS, :IDTASKS)';

        $conn = new Sql();
        $conn->query($sql, array(
            ':IDUSER'=> $this->__get('iduser'),
            ':IDSTATUS'=> $this->__get('idstatus'),
            ':IDTASKS'=> $this->__get('destask')
        ));
    }

    public function updateIndex($column, $index)
    {
        $sql = "UPDATE tb_tasks SET $column = :INDEX
                WHERE idtask = :IDTASK && iduser = :IDUSER";

        $conn = new Sql();
        $conn->query($sql, array(
            ':INDEX'=> $index,
            ':IDUSER'=> $this->__get('iduser'),
            ':IDTASK'=> $this->__get('idtask')
        ));
    }
    
    public function delete()
    {
        $sql = 'DELETE FROM tb_tasks 
                WHERE iduser = :IDUSER && idtask = :IDTASK';

        $conn = new Sql();
        $conn->query($sql, array(
            ':IDUSER'=> $this->__get('iduser'), 
            ':IDTASK'=> $this->__get('idtask')
        ));
    }
}