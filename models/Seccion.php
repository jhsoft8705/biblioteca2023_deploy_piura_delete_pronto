<?php
class Seccion extends Conectar
 
{
     public function list_seccion(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_SECCION";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 

    public function insert_seccion($nombre,$descrip,$estado){
        try {
            $conectar = parent::Conexion();
            $sql="SP_REGISTRAR_SECCION ?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $nombre); 
            $query->bindValue(2, $descrip);
            $query->bindValue(3, $estado);  
            $query->execute();
            return "La sección se ha registrado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    public function list_seccion_id($seccion_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_SECCION_ID ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $seccion_id); 
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
    public function update_seccion($id,$nombre,$descrip,$estado){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ACTUALIZAR_SECCION ?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $id);
            $query->bindValue(2, $nombre); 
            $query->bindValue(3, $descrip);
            $query->bindValue(4, $estado); 
            $query->execute(); 
            return $query->fetchAll(PDO::FETCH_ASSOC); 
            echo "El seccion se ha actualizado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 
    public function delete_seccion($seccion_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ELIMINAR_SECCION ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $seccion_id); 
            $query->execute();
            return "El seccion se ha ELIMINADO con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
}

?>