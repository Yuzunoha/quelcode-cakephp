<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

class TestData extends Entity
{
    protected $_accessible = [
        'name' => true,
        'created' => true,
        'modified' => true,
        'is_received' => true,
        'status' => true,
    ];
}
