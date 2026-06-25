<?php
declare(strict_types=1);
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
exit;
}

$orderId = $_SESSION['last_order']['order_id'] ?? null;

if ($orderId === null) {
$this->renderJson([]);
return;
}

$data = $this->orderingModel->getOrderById($orderId);

$this->renderJson($data);
}
}

?>