<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'App/Core/BaseController.php';
require_once 'App/Model/OrderingModel.php';

class ApiController extends BaseController
{
    private OrderingModel $orderingModel;

    public function __construct()
    {
        $this->orderingModel = new OrderingModel();
    }

    public function handleRequest(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            $this->renderJson(['error' => 'Method Not Allowed']);
            return;
        }

        $orderingId = $_SESSION['ordering_id'] ?? null;

        if ($orderingId === null) {
            $this->renderJson([]);
            return;
        }

        $orders = $this->orderingModel->getByOrderingId((int)$orderingId);

        $this->renderJson($orders);
    }
}