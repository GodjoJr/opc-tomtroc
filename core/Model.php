<?php

abstract class Model
{
    protected PDO $db;

    public function __construct()
    {
        require_once ROOT_URL . '/config/database.php';
        $this->db = Database::getInstance();
    }
}
