<?php
declare(strict_types=1);

require_once 'App/Core/BaseModel.php';

class OrderingModel extends BaseModel 
{
    /**
     * all orders 
     */
    public function getAll(): array
    {
        $sql = "SELECT o.ordering_id, o.address, o.ordering_time,
                       oa.ordered_article_id, oa.article_id, oa.status,
                       a.name AS article_name, a.price AS article_price
                FROM ordering o
                JOIN ordered_article oa ON o.ordering_id = oa.ordering_id
                JOIN article a ON oa.article_id = a.article_id
                ORDER BY o.ordering_time DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC) ?: [];
    }

    /**
     * order by id
     */
    public function getById(int $id): ?array
    {
        $sql = "SELECT * FROM ordering WHERE ordering_id = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        return $row ?: null;
    }
    public function getGroupedByAddress(): array
{
    $sql = "
        SELECT 
            o.ordering_id,
            o.address,
            o.ordering_time,
            oa.ordered_article_id,
            oa.article_id,
            oa.status,
            a.name AS article_name,
            a.price AS article_price
        FROM ordering o
        JOIN ordered_article oa ON o.ordering_id = oa.ordering_id
        JOIN article a ON oa.article_id = a.article_id
        ORDER BY o.address, o.ordering_time DESC
    ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC) ?: [];
}

    /**
     * new order 
     */
    public function create(array $data): int
    {
        $sql = "INSERT INTO ordering (address) VALUES (?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $data['address']);
        $stmt->execute();

        return $this->db->insert_id;
    }

    /**
     *  order added to table (ordered_article-table)
     */
    public function addOrderedArticle(int $orderingId, int $articleId, int $status = 0): bool
    {
        $sql = "INSERT INTO ordered_article (ordering_id, article_id, status) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iii", $orderingId, $articleId, $status);

        return $stmt->execute();
    }

    /**
     * update status of ordered article
     */
    public function updateStatus(int $orderedArticleId, int $status): bool
    {
        $sql = "UPDATE ordered_article SET status = ? WHERE ordered_article_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $status, $orderedArticleId);

        return $stmt->execute();
    }

    /**
     * Bestellung löschen (erst ordered_article, dann ordering)
     */
    public function delete(int $id): bool
    {
        // delete alle ordered_article-Einträge 
        $sql = "DELETE FROM ordered_article WHERE ordering_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // then delete ordering 
        $sql = "DELETE FROM ordering WHERE ordering_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    /**
     * get orders with status from baker and driver
     */
    public function getOrdersWithStatus(): array
    {
        return $this->getAll();  // Gleiche Query wie getAll()
    }
}