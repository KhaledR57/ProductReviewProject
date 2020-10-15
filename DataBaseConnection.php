<?php

class DataBaseConnection
{
    private $conn;
    private $DB_host = "localhost";
    private $DB_user = "root";
    private $DB_password = "";
    private $DB_name = "test3";
    private static $instance = null;

    private function __construct()
    {
        $this->conn = new mysqli($this->DB_host, $this->DB_user, $this->DB_password, $this->DB_name);

        // Error handling
        if (mysqli_connect_error()) {
            trigger_error("Failed to connect to MySQL: " . mysql_connect_error(), E_USER_ERROR);
        }
    }

    // Create Instance If It There Is no Instance
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Return connection
    public function getConnection()
    {
        return $this->conn;
    }
}