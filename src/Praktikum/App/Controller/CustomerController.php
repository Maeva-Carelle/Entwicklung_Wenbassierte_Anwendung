<?php
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'App/Core/BaseController.php';
require_once 'App/Model/OrderingModel.php';

class CustomerController extends BaseController 
{
    private OrderingModel $orderingModel;

    public function __construct()
    {
        $this->orderingModel = new OrderingModel();
    }

    public function processData(): void 
    {
    }

    public function getData(): array 
    {
        $orderingId = $_SESSION['ordering_id'] ?? null;

        $orders = [];

        if ($orderingId !== null) {
            $orders = $this->orderingModel->getByOrderingId((int)$orderingId);
        }

        $message = $_GET['message'] ?? '';
        
        return [
            'orders' => $orders,
            'message' => $message
        ];
    }

    public function generateResponse(): void 
    {
        $data = $this->getData();
        $this->renderHtml('App/View/customer.view.php', ['data' => $data]);
    }

    public function handleRequest(): void 
    {
        $this->processData();
        $this->generateResponse();
    }
}