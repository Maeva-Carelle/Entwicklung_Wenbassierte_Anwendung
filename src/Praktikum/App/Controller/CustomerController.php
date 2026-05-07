<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';


class CustomerController extends BaseController
{

    /**
     * Generate the full response output.
     * This method may output HTML, JSON, or other formats as needed.
     *
     * @return void
     */
    public function generateResponse(): void {
        $this->renderHtml('App/View/customer.view.php');
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
}