<?php
class Grado extends Conectar
 
{
     public function list_grado(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_GRADO";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 

    public function insert_grado($nombres,$descripcion,$nivel,$estado){
        try {
            $conectar = parent::Conexion();
            $sql="SP_REGISTRAR_GRADO ?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $nombres);
            $query->bindValue(2, $descripcion);    
            $query->bindValue(3, $nivel);
            $query->bindValue(4, $estado); 
            $query->execute();
            return "El Grado se ha registrado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    public function list_grado_id($grado_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_GRADO_ID ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $grado_id); 
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
    public function update_grado($id,$nombres,$descripcion,$nivel,$estado){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ACTUALIZAR_GRADO ?,?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $id);
            $query->bindValue(2, $nombres);
            $query->bindValue(3, $descripcion);    
            $query->bindValue(4, $nivel);
            $query->bindValue(5, $estado); 
            $query->execute(); 
            return $query->fetchAll(PDO::FETCH_ASSOC); 
            echo "El Grado se ha actualizado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 
    public function delete_grado($grado_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ELIMINAR_GRADO ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $grado_id); 
            $query->execute();
            return "El Grado se ha ELIMINADO con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
}

?>