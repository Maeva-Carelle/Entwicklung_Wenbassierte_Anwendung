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
     * // 0 = bestellt
     * // 1 = in Vorbereitung
     * // 2 = fertig
     * // 3 = unterwegs
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

    
/* this is for driver*/
    public function getOrdersReadyForDelivery(): array
{
    $sql = "
        SELECT 
            o.ordering_id,
            o.address,
            o.ordering_time,
            SUM(a.price) AS total_price
        FROM ordering o
        JOIN ordered_article oa ON o.ordering_id = oa.ordering_id
        JOIN article a ON oa.article_id = a.article_id
        GROUP BY o.ordering_id
        HAVING MIN(oa.status) >= 2
           
    ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC) ?: [];
}
    


public function updateOrderStatus(int $orderingId,int $status): bool
{
    $sql = "
        UPDATE ordered_article
        SET status = ?
        WHERE ordering_id = ?
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->bind_param(
        "ii",
        $status,
        $orderingId
    );

    return $stmt->execute();
}
    public function getGroupedOrdersForBaker(): array
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
        WHERE oa.status < 3
        ORDER BY o.ordering_time DESC
    ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $grouped = [];

        foreach ($rows as $row) {

            $id = $row['ordering_id'];

            if (!isset($grouped[$id])) {
                $grouped[$id] = [
                    'ordering_id' => $row['ordering_id'],
                    'address' => $row['address'],
                    'ordering_time' => $row['ordering_time'],
                    'articles' => []
                ];
            }

            $grouped[$id]['articles'][] = [
                'ordered_article_id' => $row['ordered_article_id'],
                'article_name' => $row['article_name'],
                'article_price' => $row['article_price'],
                'status' => $row['status']
            ];
        }

        return $grouped;
    }

}

