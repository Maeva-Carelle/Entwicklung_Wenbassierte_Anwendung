<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';
require_once 'App/Model/OrderingModel.php';
require_once 'App/Core/Router.php';

class DriverController extends BaseController 
{
    private OrderingModel $orderingModel;

    public function __construct()
    {
        $this->orderingModel = new OrderingModel();
    }

    public function processData(): void 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['delete_ordering_id'])) {
                // Bestellung löschen (ausgeliefert)
                $this->orderingModel->delete((int)$_POST['delete_ordering_id']);
                
                header('Location: ' . Router::generateUrl('driver') . '?message=deleted');
                exit;
            } elseif (isset($_POST['ordered_article_id'])) {
                // Status update
                $status = (int)$_POST['status'];
                $orderedArticleId = (int)$_POST['ordered_article_id'];
                $this->orderingModel->updateStatus($orderedArticleId, $status);
                
                header('Location: ' . Router::generateUrl('driver') . '?message=updated');
                exit;
            }
        }
    }

    public function getData(): array 
    {
        $orders = $this->orderingModel->getOrdersWithStatus();
        
        return [
            'orders' => $orders,
            
        ];
    }

    public function generateResponse(): void 
    {
        $data = $this->getData();
        $this->renderHtml('App/View/driver.view.php', ['data' => $data]);
    }

    public function handleRequest(): void 
    {
        $this->processData();
        $this->generateResponse();
    }
}