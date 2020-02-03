<?php 

namespace Aplication\Model;

use Zend\Hydrator\Reflection;

class Attachment 
{

    public $id;
    public $name;
    public $file;
    public $ticket;

    public function exchangeArray(array $data)
    {
        (new Reflection())->hydrate($data, $this);
    }

    public function getArrayCopy()
    {
        return (new Reflection())->extract($data, $this);
    }


}