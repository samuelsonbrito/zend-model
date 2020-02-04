<?php 

namespace Aplication\Model;

use Core\Model\AbstractCoreModelTable;

class TicketTable extends AbstractCoreModelTable
{
    public function findAll(array $params)
    {
        return $this->tableGateway->select($params);
    }

}