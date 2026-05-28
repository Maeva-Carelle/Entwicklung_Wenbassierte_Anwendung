<?php
// App/Model/StatusModel.php Status-Werte sind hier
declare(strict_types=1);

require_once 'App/Core/BaseModel.php';

/**
 * StatusModel – verwaltet alle Datenbankzugriffe für Status-Werte.
 *
 * Implements CRUD operations for the statuses table.
 */
class StatusModel extends BaseModel 
{
    /**
     * Read - Retrieve all statuses.
     *
     * @return array List of all statuses
     */
    public function getAll(): array
    {
        $sql = "SELECT id, name, description FROM statuses";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC) ?: [];
    }

    /**
     * Create - Insert a new status into the database.
     *
     * @param array $data Status data (name, description)
     * @return bool Success status
     */
    public function create(array $data): bool
    {
        $sql = "INSERT INTO statuses (name, description) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        
        $description = $data['description'] ?? null;
        $stmt->bind_param("ss", $data['name'], $description);

        return $stmt->execute();
    }

    /**
     * Read (Single) - Retrieve a specific status by its ID.
     *
     * @param int $id The status ID
     * @return array|null The status data or null if not found
     */
    public function getById(int $id): ?array
    {
        $sql = "SELECT id, name, description FROM statuses WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $row = $result->fetch_assoc();
        return $row ?: null;
    }

    /**
     * Update - Modify an existing status.
     *
     * @param int $id The status ID
     * @param array $data The new status data
     * @return bool Success status
     */
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE statuses SET name = ?, description = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssi", $data['name'], $data['description'], $id);

        return $stmt->execute();
    }

    /**
     * Delete - Remove a status from the database.
     *
     * @param int $id The status ID
     * @return bool Success status
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM statuses WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }
}