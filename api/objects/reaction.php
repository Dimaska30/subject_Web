<?php

class Reaction
{
    private $conn;
    private $table_name = "reaction";
    public $ID_post;
    public $ID_user;
    public $Reaction;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY Reaction DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET 
        ID_post=:ID_post, ID_user=:ID_user, Reaction=:Reaction";

        $stmt = $this->conn->prepare($query);

        $this->ID_post = htmlspecialchars(strip_tags($this->ID_post));
        $this->ID_user = htmlspecialchars(strip_tags($this->ID_user));
        $this->Reaction = htmlspecialchars(strip_tags($this->Reaction));

        $stmt->bindParam(":ID_post", $this->ID_post);
        $stmt->bindParam(":ID_user", $this->ID_user);
        $stmt->bindParam(":Reaction", $this->Reaction);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE ID_post = ? and ID_user = ?";

        $stmt = $this->conn->prepare($query);

        $this->ID_post = htmlspecialchars(strip_tags($this->ID_post));
        $this->ID_user = htmlspecialchars(strip_tags($this->ID_user));

        $stmt->bindParam(1, $this->ID_post);
        $stmt->bindParam(1, $this->ID_user);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function update()
    {
        $query = "UPDATE " . $this->table_name . " SET
        Reaction = :Reaction
            WHERE
            ID_user = :ID_user AND ID_post = :ID_post";

        $stmt = $this->conn->prepare($query);

        $this->ID_post = htmlspecialchars(strip_tags($this->ID_post));
        $this->ID_user = htmlspecialchars(strip_tags($this->ID_user));
        $this->Reaction = htmlspecialchars(strip_tags($this->Reaction));

        $stmt->bindParam(":ID_post", $this->ID_post);
        $stmt->bindParam(":ID_user", $this->ID_user);
        $stmt->bindParam(":Reaction", $this->Reaction);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}