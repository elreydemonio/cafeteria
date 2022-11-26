<?php

require_once "../controller/productController.php";
require_once "../model/productoModel.php";

class ajaxProduct
{

    public $id;
    public  $name;
    public  $reference;
    public  $price;
    public  $weight;
    public  $category;
    public  $stock;

    public function getProduct()
    {
        ProductController::getProductsController();
    }
    public function registerProductAjax()
    {
        $response = ProductController::registerProduct(
            $this->name,
            $this->reference,
            $this->price,
            $this->weight,
            $this->category,
            $this->stock
        );
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
    public function deleteProductAjax()
    {
        $response = ProductController::deleteProductController($this->id);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
    public function updateData()
    {
        $response = ProductController::updateProductController(
            $this->id,
            $this->name,
            $this->reference,
            $this->price,
            $this->weight,
            $this->category,
            $this->stock,
        );
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}

if (!isset($_POST["accion"])) {
    $response = new ajaxProduct();
    $response->getProduct();
} else {

    if ($_POST["accion"] == "new") {
        $new = new ajaxProduct();
        $new->name = $_POST["name"];
        $new->reference = $_POST["reference"];
        $new->price = $_POST["price"];
        $new->weight = $_POST["weight"];
        $new->category = $_POST["category"];
        $new->stock = $_POST["stock"];
        $new->registerProductAjax();
    }

    if ($_POST["accion"] == "delete") {
        $delete = new ajaxProduct();

        $delete->id = $_POST["id"];

        $delete->deleteProductAjax();
    }

    if ($_POST["accion"] == "update") {
        $update = new ajaxProduct();

        $update->id = $_POST["id"];
        $update->name = $_POST["name"];
        $update->reference = $_POST["reference"];
        $update->price = $_POST["price"];
        $update->weight = $_POST["weight"];
        $update->category = $_POST["category"];
        $update->stock = $_POST["stock"];

        $update->updateData();
    }
}
