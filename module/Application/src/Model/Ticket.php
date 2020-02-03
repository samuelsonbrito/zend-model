<?php 

namespace Aplication\Model;

use Zend\Hydrator\Reflection;

class Ticket 
{
    const LOW = 0;
    const MEDIUM = 1;
    const HIGH = 2;

    public $id;
    public $name;
    public $description;
    public $priority;
    public $create_at;
    public $user;

    public function exchangeArray(array $data)
    {
        (new Reflection())->hydrate($data, $this);
    }

    public function getArrayCopy()
    {
        return (new Reflection())->extract($data, $this);
    }

    public function getPriorityDescription()
    {
        return [
            self::LOW => 'Baixo',
            self::MEDIUM => 'Medio',
            self::HIGH => 'Alto',

        ];
    }

    public function getPrioriry($priority)
    {
        switch($priority){

            case self::LOW:
                return 'Baixo';
            break;

            case self::MEDIUM:
                return 'Medio';
            break;

            case self::HIGH:
                return 'Alto';
            break;
        }
    }


}