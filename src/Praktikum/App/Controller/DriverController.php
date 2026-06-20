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

            // STATUS UPDATE
            if (isset($_POST['ordering_id'], $_POST['status'])) {

                $this->orderingModel->updateOrderItemsStatus(
                    (int)$_POST['ordering_id'],
                    (int)$_POST['status']
                );

                header('Location: ' . Router::generateUrl('driver') . '?message=updated');
                exit;
            }

            // DELETE (ausgeliefert)
            if (isset($_POST['delete_ordering_id'])) {

                $this->orderingModel->delete((int)$_POST['delete_ordering_id']);

                header('Location: ' . Router::generateUrl('driver') . '?message=deleted');
                exit;
            }
        }
    }

    public function getData(): array
    {
        return [
            'orders' => $this->orderingModel->getOrdersReadyForDelivery()
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