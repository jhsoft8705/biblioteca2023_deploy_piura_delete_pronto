<?php
class Categoria extends Conectar
 
{
     public function list_category(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_CATEGORIA";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 

    public function insert_category($nombres,$descrip,$estado){
        try {
            $conectar = parent::Conexion();
            $sql="SP_REGISTRAR_CATEGORIA ?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $nombres); 
            $query->bindValue(2, $descrip);
            $query->bindValue(3, $estado);  
            $query->execute();
            return "La Categoria se ha registrado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    public function list_category_id($categoria_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_CATEGORIA_ID ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $categoria_id); 
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
    public function update_category($id,$nombres,$descrip,$estado){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ACTUALIZAR_CATEGORIA ?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $id);
            $query->bindValue(2, $nombres); 
            $query->bindValue(3, $descrip);
            $query->bindValue(4, $estado); 
            $query->execute(); 
            return $query->fetchAll(PDO::FETCH_ASSOC); 
            echo "La categoria se ha actualizado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 
    public function delete_category($categoria_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ELIMINAR_CATEGORIA ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $categoria_id); 
            $query->execute();
            return "La categoria se ha ELIMINADO con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
}

?>