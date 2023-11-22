<?php
    require_once("../config/conexion.php");
    require_once("../models/Bodega.php");

    $producto = new Producto ();
    $body = json_decode(file_get_contents("php://input"), true);
    switch ($_GET["op"]) {
        case "GetAll_productos";
            $datos=$producto->get_producto();
            echo json_encode($datos);
            break;
        case "GetAll_ingreso";
            $datos=$producto->get_ingreso();
            echo json_encode($datos);
            break;
        case "GetAll_ventas";
            $datos=$producto->get_ventas();
            echo json_encode($datos);
            break;
        case "Update";
            $datos=$producto->update_producto($body["IdProducto"],$body["Nproducto"],$body["Precio"]);
            echo ("Update correcto");
            break;
        case "Delete";
            $datos=$producto->delete_producto($body["IdProducto"]);
            echo ("Delete Correcto");
            break;
        case "Insert_ingreso";
            $datos=$producto->insert_ingreso($body["IdIngreso"], $body["IdProducto"], $body["Cantidad"], $body["Fecha"]);
            echo ("Insert Ingreso correcto");
            break;
        case "Insert_venta";
            $datos=$producto->insert_venta($body["IdVenta"], $body["IdProducto"], $body["Cantidad"], $body["Fecha"]);
            echo ("Insert Ventas correcto");
            break;
        case "Insert_producto";
            $datos=$producto->insert_producto($body["IdProducto"],$body["Nproducto"],$body["Precio"], $body["Cantidad"], $body["Disponibilidad"]);
            echo ("Insert Producto correcto");
            break;
    }
?>