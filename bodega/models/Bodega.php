<?php
    class Producto extends Conectar {
        public function get_producto(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT IdProducto, Nproducto, precio, Cantidad FROM productos Where Disponibilidad=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC); 
        }
        public function get_ingreso(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM ingreso";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC); 
        }
        public function get_ventas(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM ventas";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC); 
        }
        public function update_producto($IdProducto, $Nproducto, $Precio){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE productos set Nproducto = ?, Precio = ? WHERE IdProducto = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $Nproducto);
            $sql->bindValue(2, $Precio);
            $sql->bindValue(3, $IdProducto);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function delete_producto($IdProducto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE productos set Disponibilidad = 0 WHERE IdProducto = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $IdProducto);
            $sql->execute();
            return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
        public function Insert_ingreso($IdIngreso, $IdProducto, $Cantidad, $Fecha) {
            $conectar = parent::conexion();
            parent::set_names();
        
            $sql = "INSERT INTO ingreso (IdIngreso, IdProducto, Cantidad, Fecha) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $IdIngreso);
            $stmt->bindValue(2, $IdProducto);
            $stmt->bindValue(3, $Cantidad);
            $stmt->bindValue(4, $Fecha);
            $stmt->execute();
            
            $sql = "SELECT Cantidad FROM productos WHERE IdProducto = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $IdProducto);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $suma = $res['Cantidad'] + $Cantidad; 
            
            $sql = "UPDATE productos SET Cantidad = ? WHERE IdProducto = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $suma);
            $stmt->bindValue(2, $IdProducto);
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        public function Insert_venta($IdVenta, $IdProducto, $Cantidad, $Fecha) {
            $conectar = parent::conexion();
            parent::set_names();
        
            $sql = "INSERT INTO ventas (IdVenta, IdProducto, Cantidad, Fecha) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $IdVenta);
            $stmt->bindValue(2, $IdProducto);
            $stmt->bindValue(3, $Cantidad);
            $stmt->bindValue(4, $Fecha);
            $stmt->execute();
            
            $sql = "SELECT Cantidad FROM productos WHERE IdProducto = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $IdProducto);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $suma = $res['Cantidad'] - $Cantidad; 
            
            $sql = "UPDATE productos SET Cantidad = ? WHERE IdProducto = ?";
            $stmt = $conectar->prepare($sql);
            $stmt->bindValue(1, $suma);
            $stmt->bindValue(2, $IdProducto);
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        public function Insert_producto($IdProducto,$Nproducto,$Precio, $Cantidad, $Disponibilidad) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO productos (IdProducto,Nproducto,Precio, Cantidad, Disponibilidad) 
                    VALUES (?, ?, ?, ?, ?)";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $IdProducto);
            $sql->bindValue(2, $Nproducto);
            $sql->bindValue(3, $Precio);
            $sql->bindValue(4, $Cantidad);
            $sql->bindValue(5, $Disponibilidad);
            $sql->execute();
        }
    }
    
?>