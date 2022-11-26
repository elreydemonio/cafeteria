<?php

require_once "../model/productoModel.php";

class ProductController
{
    static function getProductsController()
    {
        $response = ProductModel::getProducts();
        echo json_encode($response);
    }

    static function registerProduct(
        $name,
        $reference,
        $price,
        $weight,
        $category,
        $stock,
    ) {
        $response = ProductModel::registerProduct(
            $name,
            $reference,
            $price,
            $weight,
            $category,
            $stock,
        );
        return $response;
    }

    static function deleteProductController($id)
    {
        $response = ProductModel::deleteProduct($id);
        return $response;
    }

    static function getProductController($id)
    {
        $response = ProductModel::getProduct($id);
        return $response;
    }

    static function updateProductController(
        $id,
        $name,
        $reference,
        $price,
        $weight,
        $category,
        $stock,
    ) {
        $response = ProductModel::updateProduct(
            $id,
            $name,
            $reference,
            $price,
            $weight,
            $category,
            $stock,
        );
        return $response;
    }
}
