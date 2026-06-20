<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';
require_once 'App/Model/OrderingModel.php';
require_once 'App/Core/Router.php';

class BakerController extends BaseController 
{
    private OrderingModel $orderingModel;

    public function __construct()
    {
        $this->orderingModel = new OrderingModel();
    }

    public function processData(): void 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ordered_article_id'])) {
            $status = (int)$_POST['status'];
            $orderedArticleId = (int)$_POST['ordered_article_id'];
            
            $this->orderingModel->updateStatus($orderedArticleId, $status);
            
            // PRG-Pattern
            header('Location: ' . Router::generateUrl('baker') . '?message=updated');
            exit;
        }
    }

    public function getData(): array
    {
        return [
            'orders' => $this->orderingModel->getGroupedOrdersForBaker(),
            'page_title' => 'Bäcker-Ansicht'
        ];
    }
    

    public function generateResponse(): void 
    {
        $data = $this->getData();
        $this->renderHtml('App/View/baker.view.php', ['data' => $data]);
    }

    public function handleRequest(): void 
    {
        $this->processData();
        $this->generateResponse();
    }

}