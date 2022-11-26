<?php

require_once "../model/saleProductModel.php";


class SaleProductController
{
    static function getSaleProductsController()
    {
        $response = SaleProductModel::getSaleProducts();
        echo json_encode($response);
    }
    static function savedSaleProductController($idProduct, $cantidad)
    {
        $response = SaleProductModel::savedSaleProduct($idProduct, $cantidad);
        echo json_encode($response);
    }
    static function getProductSaleController()
    {
        $response = SaleProductModel::getProductsSale();
        echo json_encode($response);
    }
    static function deleteSaleProduct($idProduct, $sale)
    {
        $response = SaleProductModel::deleteSaleProduct($idProduct, $sale);
        echo json_encode($response);
    }
}
