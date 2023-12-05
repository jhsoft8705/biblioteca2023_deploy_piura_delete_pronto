<?php
class Dashboard extends Conectar
 
{
     public function get_dona(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_DONA";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }

    public function get_op_recientes(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_OPERACIONES_RECIENTES";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }

}?>
