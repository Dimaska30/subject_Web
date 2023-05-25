<?php

class Favorites
{
    private $conn;
    private $table_name = "favorites";
    public $ID;
    public $ID_post;
    public $ID_user;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET 
        ID_post=:ID_post, ID_user=:ID_user";

        $stmt = $this->conn->prepare($query);

        $this->ID_post = htmlspecialchars(strip_tags($this->ID_post));
        $this->ID_user = htmlspecialchars(strip_tags($this->ID_user));

        $stmt->bindParam(":ID_post", $this->ID_post);
        $stmt->bindParam(":ID_user", $this->ID_user);

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
        $query = "UPDATE " . $this->table_name . " SET
        ID_post = :ID_post,
        ID_user = :ID_user
            WHERE
            ID = :ID";

        $stmt = $this->conn->prepare($query);

        $this->ID_post = htmlspecialchars(strip_tags($this->ID_post));
        $this->ID_user = htmlspecialchars(strip_tags($this->ID_user));
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        $stmt->bindParam(":ID_post", $this->ID_post);
        $stmt->bindParam(":ID_user", $this->ID_user);
        $stmt->bindParam(":ID", $this->ID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}