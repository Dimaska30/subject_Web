<?php

class User
{
    private $conn;
    private $table_name = "user";
    public $ID;
    public $login;
    public $Email;
    public $Password;
    public $Picture;
    public $role;
    public $token;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY login DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET 
        login=:login, Email=:Email, Password=:Password, Picture=:Picture, role=:role";

        $stmt = $this->conn->prepare($query);

        $this->login = htmlspecialchars(strip_tags($this->login));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->Password = htmlspecialchars(strip_tags($this->Password));
        $this->Picture = htmlspecialchars(strip_tags($this->Picture));
        $this->role = htmlspecialchars(strip_tags($this->role));

        $stmt->bindParam(":login", $this->login);
        $stmt->bindParam(":Email", $this->Email);
        $stmt->bindParam(":Password", $this->Password);
        $stmt->bindParam(":Picture", $this->Picture);
        $stmt->bindParam(":role", $this->role);

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
                login = :login,
                Email = :Email,
                ID_autor = :ID_autor,
                main_picture = :main_picture
                Public_date = :Public_date
            WHERE
            ID = :ID";

        $stmt = $this->conn->prepare($query);

        $this->login = htmlspecialchars(strip_tags($this->login));
        $this->Email = htmlspecialchars(strip_tags($this->Email));
        $this->Password = htmlspecialchars(strip_tags($this->Password));
        $this->Picture = htmlspecialchars(strip_tags($this->Picture));
        $this->role = htmlspecialchars(strip_tags($this->role));
        $this->token = htmlspecialchars(strip_tags($this->token));
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        $stmt->bindParam(":login", $this->login);
        $stmt->bindParam(":Email", $this->Email);
        $stmt->bindParam(":Password", $this->Password);
        $stmt->bindParam(":Picture", $this->Picture);
        $stmt->bindParam(":role", $this->role);
        $stmt->bindParam(":token", $this->token);
        $stmt->bindParam(":ID", $this->ID);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}