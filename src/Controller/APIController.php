<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Services\ProductManager;

class APIController extends AbstractController
{

    public function addProduct(Request $request, productManager $productManager): Response
    {
        $data = json_decode($request->getContent());
        $response = $productManager->addProduct($data);
        return $this->json($response);
    }

    public function updateProduct(int $id, Request $request, ProductManager $productManager): Response
    {
        $data = json_decode($request->getContent());
        $response = $productManager->updateProduct($id, $data);
        return $this->json($response);
    }

    public function search(Request $request, ProductManager $productManager): Response
    {
        $data = json_decode($request->getContent());
        $response = $productManager->search($data);
        return $this->json($response);
    }

    public function getAllCategory(ProductManager $productManager): Response
    {
        $response = $productManager->getAllCategory();
        return $this->json($response);
    }
}
