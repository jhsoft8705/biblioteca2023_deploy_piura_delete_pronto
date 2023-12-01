<?php
class Autor extends Conectar
 
{
     public function list_author(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_AUTOR";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 

    public function insert_author($nombres,$nacionalidad,$fecha_nacimiento,$estado){
        try {
            $conectar = parent::Conexion();
            $sql="SP_REGISTRAR_AUTOR ?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $nombres);
            $query->bindValue(2, $nacionalidad);    
            $query->bindValue(3, $fecha_nacimiento);
            $query->bindValue(4, $estado); 
            $query->execute();
            return "El Autor se ha registrado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    public function list_author_id($autor_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_AUTOR_ID ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $autor_id); 
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
    public function update_author($id,$nombres,$nacionalidad,$fecha_nacimiento,$estado){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ACTUALIZAR_AUTOR ?,?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $id);
            $query->bindValue(2, $nombres);
            $query->bindValue(3, $nacionalidad);    
            $query->bindValue(4, $fecha_nacimiento);
            $query->bindValue(5, $estado); 
            $query->execute(); 
            return $query->fetchAll(PDO::FETCH_ASSOC); 
            echo "El Autor se ha actualizado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 
    public function delete_author($autor_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ELIMINAR_AUTOR ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $autor_id); 
            $query->execute();
            return "El autor se ha ELIMINADO con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
}

?>