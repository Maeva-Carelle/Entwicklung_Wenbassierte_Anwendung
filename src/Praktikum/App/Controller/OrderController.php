<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';
require_once 'App/Model/ArticleModel.php';


class OrderController extends BaseController
{

    /**
     * Generate the full response output.
     * This method may output HTML, JSON, or other formats as needed.
     *
     * @return void
     */
    public function generateResponse(): void {
        $this->renderHtml('App/View/order.view.php');
    }

    /**
     * Handles the request lifecycle for the about page.
     *
     * @return void
     */
    public function handleRequest(): void
    {
        $this->generateResponse();
    }

    public function getData()
    {
        $articleModel = new ArticleModel();
        return [
            'articles' => $articleModel->getAllArticles()
        ];
    }




    public function processData()
    {
        // Hier später: CREATE, UPDATE, DELETE
        // Jetzt: nur Platzhalter
    }

   

      


}