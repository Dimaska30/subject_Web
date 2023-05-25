<?php

class Pictures
{
    private $conn;
    private $table_name = "pictures";
    public $ID;
    public $ID_post;
    public $picture;

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
        ID_post=:ID_post, picture=:picture";

        $stmt = $this->conn->prepare($query);

        $this->ID_post = htmlspecialchars(strip_tags($this->ID_post));
        $this->picture = htmlspecialchars(strip_tags($this->picture));

        $stmt->bindParam(":ID_post", $this->ID_post);
        $stmt->bindParam(":picture", $this->picture);

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
                picture = :picture
            WHERE
            ID = :ID";

        $stmt = $this->conn->prepare($query);

        $this->ID_post = htmlspecialchars(strip_tags($this->ID_post));
        $this->picture = htmlspecialchars(strip_tags($this->picture));
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        $stmt->bindParam(":ID_post", $this->ID_post);
        $stmt->bindParam(":picture", $this->picture);
        $stmt->bindParam(":ID", $this->ID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}