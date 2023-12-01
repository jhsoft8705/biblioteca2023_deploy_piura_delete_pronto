<?php
class Estudiante extends Conectar
 
{
     public function liststuden(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_ESTUDIANTE";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    public function list_comb_grados(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_GRADOS";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }

    public function list_comb_secciones(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_SECCIONES";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
    public function insert_studen($codigo, $nombre, $apellido, $id_grado, $id_seccion, $direccion, $telefono, $correo, $genero, $nacimiento, $estado) {
        try {
            $conectar = parent::Conexion();
            $sql = "SP_REGISTRAR_ESTUDIANTE ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $codigo);
            $query->bindValue(2, $nombre);
            $query->bindValue(3, $apellido);
            $query->bindValue(4, $id_grado);
            $query->bindValue(5, $id_seccion);
            $query->bindValue(6, $direccion);
            $query->bindValue(7, $telefono);
            $query->bindValue(8, $correo);
            $query->bindValue(9, $genero);
            $query->bindValue(10, $nacimiento);
            $query->bindValue(11, $estado);
            $query->execute();
            return "El estudiante se ha registrado con éxito.";
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return ["error" => "Ocurrió un error al ejecutar consulta"];
        }
    }
    
    public function list_studen_id($estdiante_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_ESTUDIANTE_ID ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $estdiante_id); 
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
    public function update_studen($id, $codigo, $nombre, $apellido, $id_grado, $id_seccion, $direccion, $telefono, $correo, $genero, $nacimiento, $estado) {
        try {
            $conectar = parent::Conexion();
            $sql = "EXEC SP_ACTUALIZAR_ESTUDIANTE ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $id);
            $query->bindValue(2, $codigo);
            $query->bindValue(3, $nombre);
            $query->bindValue(4, $apellido);
            $query->bindValue(5, $id_grado);
            $query->bindValue(6, $id_seccion);
            $query->bindValue(7, $direccion);
            $query->bindValue(8, $telefono);
            $query->bindValue(9, $correo);
            $query->bindValue(10, $genero);
            $query->bindValue(11, $nacimiento);
            $query->bindValue(12, $estado);
            $query->execute();
            echo "El estudiante se ha actualizado con éxito.";
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return ["error" => "Ocurrió un error al ejecutar la consulta"];
        }
    }
    
    public function delete_studen($estdiante_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ELIMINAR_ESTUDIANTE ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $estdiante_id); 
            $query->execute();
            return "El estudiante se ha ELIMINADO con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
}

?>