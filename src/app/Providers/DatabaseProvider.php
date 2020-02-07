<?php declare (strict_types = 1);

class DatabaseProvider
{
    private $connection;

    public function __construct($host, $username, $password, $database) {
        $this->connection = mysqli_connect($host, $username, $password, $database);

        if (!$this->connection) {
            throw new Exception("Failed to connect to the database.");
        }
    }

    public function query($command)
    {
        $this->connection->query($command);
    }
}