<?php

namespace Core;

use PDO;

/**
 * Class that allows to connect to the database.
 * This class is a singleton. This means that it is not possible to create multiple instances of this class.
 * To get an instance of this class, you must use the getInstance() method.
 */
class Database 
{
    // Creation of a singleton class that allows to connect to the database.
    // We create an instance of the DBConnect class that allows to connect to the database.
    private static $instance;

    private $db;

    /**
     * Constructor of the Database class.
     * Initializes the connection to the database.
     * This constructor is private. To get an instance of the class, you must use the getInstance() method.
     * @see Database::getInstance()
     */
    private function __construct() 
    {
        // On se connecte à la base de données.
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    /**
     * Method that allows to retrieve the instance of the Database class.
     * @return Database
     */
    public static function getInstance() : Database
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * Method that allows to retrieve the PDO object which allows to connect to the database.
     * @return PDO
     */
    public function getPDO() : PDO
    {
        return $this->db;
    }

    /**
     * Method that allows to execute a SQL query.
     * If parameters are passed, we use a prepared query.
     * @param string $sql : the SQL query to execute.
     * @param array|null $params : the parameters of the SQL query.
     * @return \PDOStatement : the result of the SQL query.
     */
    public function query(string $sql, ?array $params = null): \PDOStatement          
    {
        if ($params == null) {
            $query = $this->db->query($sql);
        } else {
            $query = $this->db->prepare($sql);
            $query->execute($params);
        }
        return $query;
    }
    
}
