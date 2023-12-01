<?php
class Ubicacion extends Conectar
 
{
     public function list_location(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_UBICACION";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 

    public function insert_location($nombres,$stank,$referencia,$estado){
        try {
            $conectar = parent::Conexion();
            $sql="SP_REGISTRAR_UBICACION ?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $nombres);
            $query->bindValue(2, $stank);    
            $query->bindValue(3, $referencia);
            $query->bindValue(4, $estado); 
            $query->execute();
            return "La Ubicacion se ha registrado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    public function list_location_id($ubicacion_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_UBICACION_ID ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $ubicacion_id); 
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
    public function update_location($id,$nombres,$stank,$referencia,$estado){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ACTUALIZAR_UBICACION ?,?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $id);
            $query->bindValue(2, $nombres);
            $query->bindValue(3, $stank);    
            $query->bindValue(4, $referencia);
            $query->bindValue(5, $estado); 
            $query->execute(); 
            return $query->fetchAll(PDO::FETCH_ASSOC); 
            echo "La Ubicacion se ha actualizado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 
    public function delete_location($ubicacion_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ELIMINAR_UBICACION ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $ubicacion_id); 
            $query->execute();
            return "La Ubicacion se ha ELIMINADO con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
}

?>