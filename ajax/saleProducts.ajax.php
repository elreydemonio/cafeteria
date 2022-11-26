<?php

require_once "../controller/salenProductController.php";
require_once "../model/saleProductModel.php";

class ajaxProductSale
{

    public function getProduct()
    {
        SaleProductController::getProductSaleController();
    }
}

if (!isset($_POST["accion"])) {
    $response = new ajaxProductSale();
    $response->getProduct();
}
