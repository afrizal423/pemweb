<?php
class Database
{   
    private $host = "localhost";
    private $db_name = "pemweb_perpus";
    private $username = "postgres";
    private $password = "afrizal99";
    public $conn;
     
    public function dbConnection()
	{
	    $this->conn = null;    
        try
		{
            $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}