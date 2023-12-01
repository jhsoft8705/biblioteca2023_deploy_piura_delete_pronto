<?php
class Prestamo extends Conectar
 
{
    public function Create_prestamo_temporal(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_UPDATE_PRESTAMO_TEMPORAL";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    
    /*TODO:*/
    public function update_reload_stock_libros(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_RELOAD_DETALLE_PRESTAMO";  
            $query = $conectar->prepare($sql);
            $query->execute();
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }

    public function list_detail_prestamo($prestamo_prestamo_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_DETALLE_PRESTAMO ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$prestamo_prestamo_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    
    public function list_detail_prestamo_update($prestamo_prestamo_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_DETALLE_PRESTAMO_UPDATE ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$prestamo_prestamo_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }

    

    public function Create_temporal_detail_total($prestamo_id_preprestamo){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ACTUALIZAR_TOTAL_DETALL_PREST ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$prestamo_id_preprestamo); 
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }

    public function Create_temporal_detail_total_update($prestamo_id_update){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ACTUALIZAR_TOTAL_DETALL_PREST_UPDATE ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1,$prestamo_id_update); 
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 
    
    public function insert_detalle_prestamo($prestamo_id_prestamo, $prestamo_id_libro, $cantprestamo_idad) {
        try {
            $conectar = parent::Conexion();
            $sql = "EXEC SP_REGISTRAR_DETALLES_PRESTAMO ?, ?, ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $prestamo_id_prestamo);
            $query->bindValue(2, $prestamo_id_libro);
            $query->bindValue(3, $cantprestamo_idad);
            $query->execute(); 
            $mensaje = $query->fetch(PDO::FETCH_ASSOC);
            return $mensaje ? $mensaje['Mensaje'] : "No se ha devuelto ningún mensaje.";
        } catch (PDOException $e) {
            return "Error en la consulta: " . $e->getMessage();
        }
    }
    public function insert_detalle_prestamo_update($prestamo_id_prestamo, $prestamo_id_libro, $cantprestamo_idad) {
        try {
            $conectar = parent::Conexion();
            $sql = "EXEC SP_REGISTRAR_DETALLES_PRESTAMO_UPDATE ?, ?, ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $prestamo_id_prestamo);
            $query->bindValue(2, $prestamo_id_libro);
            $query->bindValue(3, $cantprestamo_idad);
            $query->execute(); 
            $mensaje = $query->fetch(PDO::FETCH_ASSOC);
            return $mensaje ? $mensaje['Mensaje'] : "No se ha devuelto ningún mensaje.";
        } catch (PDOException $e) {
            return "Error en la consulta: " . $e->getMessage();
        }
    }
    public function Registrar_Prestamo($prestamo_id, $estudiante_id, $usuario_id, $fecha_prest, $fecha_devolucion, $comentario) {
        try {
            $conectar = parent::Conexion();
            $sql = "EXEC SP_REGISTRAR_PRESTAMO ?,?,?,?,?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $prestamo_id);
            $query->bindValue(2, $estudiante_id);
            $query->bindValue(3, $usuario_id);
            $query->bindValue(4, $fecha_prest);
            $query->bindValue(5, $fecha_devolucion);
            $query->bindValue(6, $comentario);
            $query->execute();
    
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return ["error" => "Ocurrió un error al ejecutar consulta: " . $e->getMessage()];
        }
    } 
 
    public function Listar_prestamos(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_PRESTAMOS";  
            $query = $conectar->prepare($sql);
             $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    
    public function list_prestamo_id($prestamo_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_PRESTAMO_ID ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $prestamo_id); 
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
    public function update_prestamo($prestamo_id,$estudiante_id,$usuario_id,$fecha_prest,$fecha_devolucion,$comentario){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ACTUALIZAR_prestamo?,?,?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $prestamo_id);
            $query->bindValue(2, $estudiante_id);
            $query->bindValue(3, $usuario_id);    
            $query->bindValue(4, $fecha_prest);
            $query->bindValue(5, $fecha_devolucion);
            $query->bindValue(6, $comentario);
            $query->execute(); 
            return $query->fetchAll(PDO::FETCH_ASSOC); 
            echo "El prestamose ha actualizado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 

    /*TODO:DEVOLUCIONES*/ 
    public function list_devolucion(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_DEVOLUCION";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }

    public function marcar_devuelto($prestamo_id){
        try {
            $conectar = parent::Conexion();
            $sql="DEVOLVER_PRESTAMO ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $prestamo_id); 
            $query->execute();
            return "El prestamo  se con éxito."; 
         } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    public function delete_detalle_prest($prestamo_id_detalle_prest){
        try {
            $conectar = parent::Conexion();
            $sql="SP_DELETE_DETALLE_PREST ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $prestamo_id_detalle_prest); 
            $query->execute();
            return "El prestamo se ha eliminado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
}

?>