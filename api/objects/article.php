<?php

class Article
{
    // подключение к базе данных и таблице "post"
    private $conn;
    private $table_name = "post";

    // свойства объекта
    public $ID;
    public $title;
    public $body;
    public $main_picture;
    public $ID_autor;
    public $Public_date;

    // конструктор для соединения с базой данных
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // метод для получения товаров
    function read()
    {
        // выбираем все записи
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY Public_date DESC";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // выполняем запрос
        $stmt->execute();
        return $stmt;
    }

    // метод для создания товаров
    function create()
    {
        // запрос для вставки (создания) записей
        $query = "INSERT INTO " . $this->table_name . " SET 
        title=:title, body=:body, ID_autor=:ID_autor, main_picture=:main_picture";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // очистка
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->ID_autor = htmlspecialchars(strip_tags($this->ID_autor));
        $this->main_picture = htmlspecialchars(strip_tags($this->main_picture));

        // привязка значений
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":ID_autor", $this->ID_autor);
        $stmt->bindParam(":main_picture", $this->main_picture);

        // выполняем запрос
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // метод для получения конкретного товара по ID
    function readOne()
    {
        // запрос для чтения одной записи (товара)
        $query = "SELECT * FROM " . $this->table_name . " WHERE ID = ? LIMIT 0,1";
                
        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // привязываем id товара, который будет получен
        $stmt->bindParam(1, $this->ID);

        // выполняем запрос
        $stmt->execute();

        // получаем извлеченную строку
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // установим значения свойств объекта
        $this->title = $row["title"];
        $this->body = $row["body"];
        $this->ID_autor = $row["ID_autor"];
        $this->main_picture = $row["main_picture"];
        $this->Public_date = $row["Public_date"];
    }

    // метод для обновления товара
    function update()
    {
        // запрос для обновления записи (товара)
        $query = "UPDATE " . $this->table_name . " SET
                title = :title,
                body = :body,
                ID_autor = :ID_autor,
                main_picture = :main_picture
                Public_date = :Public_date
            WHERE
            ID = :ID";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // очистка
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->ID_autor = htmlspecialchars(strip_tags($this->ID_autor));
        $this->main_picture = htmlspecialchars(strip_tags($this->main_picture));
        $this->Public_date = htmlspecialchars(strip_tags($this->Public_date));
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        // привязываем значения
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":ID_autor", $this->ID_autor);
        $stmt->bindParam(":main_picture", $this->main_picture);
        $stmt->bindParam(":Public_date", $this->Public_date);
        $stmt->bindParam(":ID", $this->ID);

        // выполняем запрос
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // метод для удаления товара
    function delete()
    {
        // запрос для удаления записи (товара)
        $query = "DELETE FROM " . $this->table_name . " WHERE ID = ?";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // очистка
        $this->ID = htmlspecialchars(strip_tags($this->ID));

        // привязываем id записи для удаления
        $stmt->bindParam(1, $this->ID);

        // выполняем запрос
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // метод для поиска товаров
    function search($keywords)
    {
        // поиск записей (товаров) по "названию товара", "описанию товара", "названию категории"
        $query = "SELECT * FROM " . $this->table_name . " 
            WHERE
                title LIKE ? OR body LIKE ? OR ID_autor LIKE ? OR Public_date LIKE ?
            ORDER BY
            Public_date DESC";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // очистка
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";

        // привязка
        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);
        $stmt->bindParam(4, $keywords);

        // выполняем запрос
        $stmt->execute();

        return $stmt;
    }

    // получение товаров с пагинацией
    public function readPaging($from_record_num, $records_per_page)
    {
        // выборка
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY Public_date DESC LIMIT ?, ?";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // свяжем значения переменных
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        // выполняем запрос
        $stmt->execute();

        // вернём значения из базы данных
        return $stmt;
    }

    // данный метод возвращает кол-во товаров
    public function count()
    {
        $query = "SELECT COUNT(*) as total_rows FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row["total_rows"];
    }
}
