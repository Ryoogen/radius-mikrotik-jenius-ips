<?php
class User {
    private $conn;
    private $table_name = "users"; // Change this to your actual table name

    public $id;
    public $username;
    public $email;
    public $created_at;

    public function __construct($db){
        $this->conn = $db;
    }

    // Methods for CRUD operations go here...
}
?>
