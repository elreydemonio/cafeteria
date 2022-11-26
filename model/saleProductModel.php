<?php

require_once "../config/db.php";

class SaleProductModel
{
    static public function getSaleProducts()
    {
        $stmt = Db::connection()->prepare("SELECT id, nombre FROM producto");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt = null;
    }

    static public function savedSaleProduct($idProduct, $cantidad)
    {
        $idProductInt =  intval($idProduct);
        $cantidadInt = intval($cantidad);
        $stmt = Db::connection()->prepare("SELECT * FROM producto WHERE id = :id");
        $stmt->bindParam(":id", $idProduct, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
            $stock = intval($data[0]['stock']);
            if ($stock == 0) {
                return "No hay productos en stock";
            }
            if ($stock < $cantidadInt) {
                return "No hay suficientes productos en stock";
            }
            $response = Db::connection()->prepare("INSERT INTO producto_venta(idProducto, cantidad) 
            VALUES (:idProducto,:cantidad)");
            $idProductInt =  intval($idProduct);
            $cantidadInt = intval($cantidad);
            $response->bindParam(":idProducto", $idProductInt, PDO::PARAM_INT);
            $response->bindParam(":cantidad", $cantidadInt, PDO::PARAM_INT);
            if ($response->execute()) {
                $stockNew = $stock - $cantidadInt;
                $update = Db::connection()->prepare(
                    "UPDATE producto
                    SET stock = :stock
                    WHERE id = :id"
                );
                $update->bindParam(":id", $idProduct, PDO::PARAM_INT);
                $update->bindParam(":stock", $stockNew, PDO::PARAM_INT);
                if ($update->execute()) {
                    return "Se creado correctamente la venta";
                } else {
                    return "Error";
                }
            } else {
                return "Error, ";
            }
        }
    }

    static function getProductsSale()
    {
        $stmt = Db::connection()->prepare("SELECT producto_venta.id as id, producto.id as product, producto.nombre as nombre,  producto_venta.cantidad as cantidad, 'X' as acciones
        from producto_venta inner join producto ON producto_venta.idProducto = producto.id");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt = null;
    }

    static function deleteSaleProduct($idProduct, $idSaleProduct)
    {
        $idProductInt =  intval($idProduct);
        $idSaleProductInt = intval($idSaleProduct);
        $stmt = Db::connection()->prepare("SELECT * FROM producto_venta WHERE id = :id");
        $stmt->bindParam(":id", $idSaleProductInt, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $data = $stmt->fetchAll();
            $cantidadSale = intval($data[0]['cantidad']);
            $response = Db::connection()->prepare("SELECT * FROM producto WHERE id = :id");
            $response->bindParam(":id", $idProductInt, PDO::PARAM_INT);
            if ($response->execute()) {
                $data = $response->fetchAll();
                $stock = intval($data[0]['stock']);
                $delete = Db::connection()->prepare("DELETE FROM producto_venta WHERE id = :id");

                $delete->bindParam(":id", $idSaleProductInt, PDO::PARAM_INT);

                if ($delete->execute()) {
                    $stockNew = $stock + $cantidadSale;
                    $update = Db::connection()->prepare(
                        "UPDATE producto
                        SET stock = :stock
                        WHERE id = :id"
                    );
                    $update->bindParam(":id", $idProduct, PDO::PARAM_INT);
                    $update->bindParam(":stock", $stockNew, PDO::PARAM_INT);
                    if ($update->execute()) {
                        return "Se eliminado la venta";
                    } else {
                        return "Error";
                    }
                } else {
                    return "Error, no se pudo eliminar la venta";
                }
            }
        }
    }
}
