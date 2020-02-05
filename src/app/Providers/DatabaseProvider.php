<?php declare (strict_types = 1);

class DatabaseProvider
{
    private $connection;

    public function __construct($host, $username, $password, $database) {
        $this->connection = mysqli_connect($host, $username, $password, $database);

        if (!$this->connection) {
            echo "Unable to connect to MySQL.";
            exit();
        }
    }

    public function query($command)
    {
        $this->connection->query($command);
    }
}