<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';
require_once 'App/Model/ArticleModel.php';
require_once 'App/Model/OrderingModel.php';
require_once 'App/Core/Router.php';

class OrderController extends BaseController 
{
    private ArticleModel $articleModel;
    private OrderingModel $orderingModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
        $this->orderingModel = new OrderingModel();
    }

    public function processData(): void 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // adress to formular
            $address = $_POST['address'] ?? '';
            
            // create order (only address, no customer_name)
            $orderId = $this->orderingModel->create([
                'address' => $address
            ]);
            
            // add ordered articles 
            if ($orderId && isset($_POST['articles'])) {
                foreach ($_POST['articles'] as $articleId) {
                    $this->orderingModel->addOrderedArticle(
                        $orderId, 
                        (int)$articleId, 
                        0  // Status: 0 = In Vorbereitung
                    );
                }
            }
            
            // PRG-Pattern: Redirect to POST
            header('Location: ' . Router::generateUrl('customer') . '?message=success');
            exit;
        }
    }

    public function getData(): array 
    {
        $articles = $this->articleModel->getAll();
        
        return [
            'articles' => $articles,
            'page_title' => 'Bestellung'
        ];
    }

    public function generateResponse(): void 
    {
        $data = $this->getData();
        $this->renderHtml('App/View/order.view.php', ['data' => $data]);
    }

    public function handleRequest(): void 
    {
        $this->processData();
        $this->generateResponse();
    }
}