<?php

require_once "../config/db.php";

class ProductModel
{
    static public function getProducts()
    {
        $stmt = Db::connection()->prepare("SELECT id,nombre,referencia,precio,peso,categoria,stock,fecha_creacion as fecha, 'X' as acciones FROM producto");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt = null;
    }

    static public function registerProduct(
        $name,
        $reference,
        $price,
        $weight,
        $category,
        $stock,
    ) {
        $response = Db::connection()->prepare("INSERT INTO producto(nombre, referencia, precio, peso, categoria, stock) 
                                                VALUES (:nombre,:referencia,:precio,:peso,:categoria,:stock)");
        $pricesInt =  intval($price);
        $weightInt = intval($weight);
        $stockInt = intval($stock);
        $response->bindParam(":nombre", $name, PDO::PARAM_STR);
        $response->bindParam(":referencia", $reference, PDO::PARAM_STR);
        $response->bindParam(":precio", $pricesInt, PDO::PARAM_INT);
        $response->bindParam(":peso", $weightInt, PDO::PARAM_INT);
        $response->bindParam(":categoria", $category, PDO::PARAM_STR);
        $response->bindParam(":stock", $stockInt, PDO::PARAM_INT);


        if ($response->execute()) {
            return "El producto se registro correctamente";
        } else {
            return "Error, no se pudo registrar el producto";
        }

        $response = null;
    }

    static public function deleteProduct($id)
    {
        $stmt = Db::connection()->prepare("DELETE FROM producto WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "El producto se elimino correctamente";
        } else {
            return "Error, no se pudo eliminar el producto";
        }

        $stmt = null;
    }

    static public function getProduct($id)
    {
        $stmt = Db::connection()->prepare("SELECT * FROM producto WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchAll();
        } else {
            return null;
        }

        $stmt = null;
    }

    static public function updateProduct(
        $id,
        $name,
        $reference,
        $price,
        $weight,
        $category,
        $stock,
    ) {
        $idInt =  intval($id);
        $pricesInt =  intval($price);
        $weightInt = intval($weight);
        $stockInt = intval($stock);

        $response = Db::connection()->prepare(
            "UPDATE producto
        SET nombre = :nombre,
        referencia = :referencia,
        precio = :precio,
        peso = :peso,
        categoria = :categoria,
        stock = :stock
        WHERE id = :id"
        );
        $response->bindParam(":id", $idInt, PDO::PARAM_INT);
        $response->bindParam(":nombre", $name, PDO::PARAM_STR);
        $response->bindParam(":referencia", $reference, PDO::PARAM_STR);
        $response->bindParam(":precio", $pricesInt, PDO::PARAM_INT);
        $response->bindParam(":peso", $weightInt, PDO::PARAM_INT);
        $response->bindParam(":categoria", $category, PDO::PARAM_STR);
        $response->bindParam(":stock", $stockInt, PDO::PARAM_INT);

        if ($response->execute()) {
            return "El producto se actualizo correctamente";
        } else {
            return "Error, no se pudo actualizar el producto";
        }

        $response = null;
    }
}
