<?php

namespace Api;

use Api\Abstractions\Connection;

class Client extends Connection
{
    public $db;

    public function __construct()
    {
        $this->db = self::connect();
    }
}
