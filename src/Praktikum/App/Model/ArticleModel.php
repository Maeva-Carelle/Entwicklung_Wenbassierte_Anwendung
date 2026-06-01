<?php
declare(strict_types=1);

require_once 'App/Core/BaseModel.php';

class ArticleModel extends BaseModel 
{
    /**
     * get all articles
     */
    public function getAll(): array
    {
        $sql = "SELECT article_id, name, picture, description, price FROM article";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC) ?: [];
    }

    /**
     *  get articles by id
     */
    public function getById(int $id): ?array
    {
        $sql = "SELECT article_id, name, picture, description, price FROM article WHERE article_id = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        return $row ?: null;
    }

    /**
     * create new article
     */
    public function create(array $data): int
    {
        $sql = "INSERT INTO article (name, picture,description, price) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssd",$data['name'],$data['picture'],$data['description'],$data['price']);
        $stmt->execute();

        return $this->db->insert_id;
    }

    /**
     * update article
     */
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE article SET name = ?, picture = ?, description=?, price = ? WHERE article_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssdi",$data['name'],$data['picture'],$data['description'],$data['price'],$id);

        return $stmt->execute();
    }

    /**
     * delete article
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM article WHERE article_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}