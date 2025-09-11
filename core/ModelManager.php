<?php

namespace Core;

use Core\Database;

abstract class ModelManager
{
    protected Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }
}
