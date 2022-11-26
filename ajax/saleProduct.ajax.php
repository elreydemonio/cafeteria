<?php

require_once "../controller/salenProductController.php";
require_once "../model/saleProductModel.php";

class ajaxSaleProduct
{
    public $idProduct;
    public $cantidad;
    public $idSale;

    public function getSaleProducts()
    {
        SaleProductController::getSaleProductsController();
    }
    public function savedSaleProduct()
    {
        $response = SaleProductController::savedSaleProductController($this->idProduct, $this->cantidad);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
    public function deleteSaleProduct()
    {
        $response = SaleProductController::deleteSaleProduct($this->idProduct, $this->idSale);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}

if (!isset($_POST["accion"])) {
    $response = new ajaxSaleProduct();
    $response->getSaleProducts();
} else {

    if ($_POST["accion"] == "new") {
        $new = new ajaxSaleProduct();
        $new->idProduct = $_POST["product"];
        $new->cantidad = $_POST["cantidad"];
        $new->savedSaleProduct();
    }

    if ($_POST["accion"] == "delete") {
        $delete = new ajaxSaleProduct();

        $delete->idSale = $_POST["id"];
        $delete->idProduct = $_POST["idProduct"];

        $delete->deleteSaleProduct();
    }
}
