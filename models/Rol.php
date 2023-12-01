<?php
class Rol extends Conectar
 
{
     public function list_rol(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_ROL";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 

    public function insert_rol($nombre,$descrip,$estado){
        try {
            $conectar = parent::Conexion();
            $sql="SP_REGISTRAR_ROL ?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $nombre); 
            $query->bindValue(2, $descrip);
            $query->bindValue(3, $estado);  
            $query->execute();
            return "La Categoria se ha registrado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    public function list_rol_id($rol_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_ROL_ID ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $rol_id); 
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
    public function update_rol($id,$nombre,$descrip,$estado){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ACTUALIZAR_ROL ?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $id);
            $query->bindValue(2, $nombre); 
            $query->bindValue(3, $descrip);
            $query->bindValue(4, $estado); 
            $query->execute(); 
            return $query->fetchAll(PDO::FETCH_ASSOC); 
            echo "El rol se ha actualizado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 
    public function delete_rol($rol_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ELIMINAR_ROL ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $rol_id); 
            $query->execute();
            return "El rol se ha ELIMINADO con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
}

?>