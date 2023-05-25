<?php

class Tag
{
    private $conn;
    private $table_name = "tag";
    public $ID;
    public $Name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY Name DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET 
        Name=:Name";

        $stmt = $this->conn->prepare($query);

        $this->Name = htmlspecialchars(strip_tags($this->Name));

        $stmt->bindParam(":Name", $this->Name);
 
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID = ?";

        $stmt = $this->conn->prepare($query);

        $this->ID = htmlspecialchars(strip_tags($this->ID));

        $stmt->bindParam(1, $this->ID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update()
    {
        $query = "UPDATE " . $this->table_name . " SET Name = :Name WHERE ID = :ID";

        $stmt = $this->conn->prepare($query);

        $this->Name = htmlspecialchars(strip_tags($this->Name));
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        $stmt->bindParam(":Name", $this->Name);
        $stmt->bindParam(":ID", $this->ID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}