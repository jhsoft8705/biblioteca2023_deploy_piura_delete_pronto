<?php
class Libro extends Conectar
 
{
     public function listbooks(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_LIBRO";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    public function list_comb_categories(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_CATEGORIAS";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }

    public function list_comb_athors(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_AUTORES";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }

    public function list_comb_locations(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_UBICACIONES";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }

    public function insert_book($codigo,$titulo,$id_autor,$id_ubi,$id_cate,$cantidad,$anio_publicacion){
        try {
            $conectar = parent::Conexion();
            $sql="SP_REGISTRAR_LIBRO ?,?,?,?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $codigo); 
            $query->bindValue(2, $titulo);
            $query->bindValue(3, $id_autor);    
            $query->bindValue(4, $id_ubi);
            $query->bindValue(5, $id_cate);
            $query->bindValue(6, $cantidad);
            $query->bindValue(7, $anio_publicacion);
            $query->execute();
            return "El libro se ha registrado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    public function list_books_id($libro_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_LIBRO_ID ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $libro_id); 
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
    public function update_book($id,$codigo,$titulo,$id_autor,$id_ubi,$id_cate,$cantidad,$anio_publicacion){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ACTUALIZAR_LIBRO ?,?,?,?,?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $id);
            $query->bindValue(2, $codigo);
            $query->bindValue(3, $titulo);
            $query->bindValue(4, $id_autor);    
            $query->bindValue(5, $id_ubi);
            $query->bindValue(6, $id_cate);
            $query->bindValue(7, $cantidad);
            $query->bindValue(8, $anio_publicacion);
            $query->execute(); 
            return $query->fetchAll(PDO::FETCH_ASSOC); 
            echo "El libro se ha actualizado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 
    public function delete_book($libro_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ELIMINAR_LIBRO ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $libro_id); 
            $query->execute();
            return "El libro se ha ELIMINADO con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
}

?>