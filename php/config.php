<?php
  
  class Config {
    const DBHOST = 'us-cdbr-east-06.cleardb.net';
    const DBUSER = 'bb5a7d8e29efca';
    const DBPASS = '9da1d24d';
    const DBNAME = 'heroku_302e836d67b7647';



     protected $dsn = 'mysql:host=' . self::DBHOST . ';dbname=' . self::DBNAME . '';

    protected $conn = null;

    // Method for connection to the database
    public function __construct() {
      try {
        $this->conn = new PDO($this->dsn, self::DBUSER, self::DBPASS);
        $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
      }
    }
  }

?>
