<?php

class Posts_tags_relation
{
    private $conn;
    private $table_name = "posts_tags_relation";
    public $ID;
    public $ID_post;
    public $ID_tag;

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
        ID_post=:ID_post, ID_tag=:ID_tag";

        $stmt = $this->conn->prepare($query);

        $this->ID_post = htmlspecialchars(strip_tags($this->ID_post));
        $this->ID_tag = htmlspecialchars(strip_tags($this->ID_tag));

        $stmt->bindParam(":ID_post", $this->ID_post);
        $stmt->bindParam(":ID_tag", $this->ID_tag);
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
        ID_tag = :ID_tag
            WHERE
            ID = :ID";

        $stmt = $this->conn->prepare($query);

        $this->ID_post = htmlspecialchars(strip_tags($this->ID_post));
        $this->ID_tag = htmlspecialchars(strip_tags($this->ID_tag));

        $stmt->bindParam(":ID_post", $this->ID_post);
        $stmt->bindParam(":ID_tag", $this->ID_tag);
        $stmt->bindParam(":ID", $this->ID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}