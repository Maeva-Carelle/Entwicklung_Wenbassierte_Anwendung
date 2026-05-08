<?php
// App/Model/ArticleModel.php

namespace App\Model;

require_once __DIR__ . '/../Core/BaseModel.php';

use App\Core\BaseModel;

class ArticleModel extends \BaseModel
{
    // Alle Artikel holen
    public function getAllArticles()
    {
        $sql = "SELECT * FROM articles";

        $result = $this->db->query($sql);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Einen Artikel per ID holen
    public function getArticleById($id)
    {
        $id = (int)$id;

        $sql = "SELECT * FROM articles WHERE id = $id";

        $result = $this->db->query($sql);

        return $result->fetch_assoc();
    }

    // Artikel erstellen
    public function createArticle($name)
    {
        $name = $this->db->real_escape_string($name);

        $sql = "INSERT INTO articles (name)
                VALUES ('$name')";

        return $this->db->query($sql);
    }

    // Artikel aktualisieren
    public function updateArticle($id, $name)
    {
        $id = (int)$id;
        $name = $this->db->real_escape_string($name);

        $sql = "UPDATE articles
                SET name = '$name'
                WHERE id = $id";

        return $this->db->query($sql);
    }

    // Artikel löschen
    public function deleteArticle($id)
    {
        $id = (int)$id;

        $sql = "DELETE FROM articles
                WHERE id = $id";

        return $this->db->query($sql);
    }
}