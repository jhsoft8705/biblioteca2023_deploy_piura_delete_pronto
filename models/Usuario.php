<?php
class Usuario extends Conectar
 
{
     public function listuser(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_USUARIO";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    public function list_comb_roles(){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_ROLES";  
            $query = $conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
    public function insert_user($nombre,$correo,$pass,$id_rol,$estado){
        try {
            $conectar = parent::Conexion();
            $sql="SP_REGISTRAR_USUARIO ?,?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $nombre);
            $query->bindValue(2, $correo);    
            $query->bindValue(3, $pass);
            $query->bindValue(4, $id_rol);
            $query->bindValue(5, $estado);
            $query->execute();
            return "El usuario se ha registrado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
    public function list_user_id($usuario_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_LISTAR_USUARIO_ID ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $usuario_id); 
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
    public function update_user($id,$nombre,$correo,$pass,$id_rol,$estado){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ACTUALIZAR_USUARIO ?,?,?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $id);
            $query->bindValue(2, $nombre);
            $query->bindValue(3, $correo);    
            $query->bindValue(4, $pass);
            $query->bindValue(5, $id_rol);
            $query->bindValue(6, $estado);
            $query->execute(); 
            return $query->fetchAll(PDO::FETCH_ASSOC); 
            echo "El usuario se ha actualizado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 

    public function update_perfil($id,$nombres,$doc,$tel,$dir){
        try {
            $conectar = parent::Conexion();
            $sql="SP_UPDATE_PERFIL ?,?,?,?,?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $id);
            $query->bindValue(2, $nombres);
            $query->bindValue(3, $doc);    
            $query->bindValue(4, $tel);
            $query->bindValue(5, $dir);
            $query->execute(); 
            echo "El usuario se ha actualizado con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    } 

    public function update_change_password($user_id, $password, $new_password) {
        try {
            $conectar = parent::Conexion();
            $sql = "SP_CHANGE_PASSWORD ?, ?, ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $user_id);
            $query->bindValue(2, $password);
            $query->bindValue(3, $new_password);
            $query->execute(); 
            $mensaje = $query->fetch(PDO::FETCH_ASSOC);
        return $mensaje ? $mensaje['Mensaje'] : "No se ha devuelto ningún mensaje.";
        } catch (PDOException $e) {
            return "Error en la consulta: " . $e->getMessage();
        }
    }


    public function delete_user($usuario_id){
        try {
            $conectar = parent::Conexion();
            $sql="SP_ELIMINAR_USUARIO ?";  
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $usuario_id); 
            $query->execute();
            return "El usuario se ha ELIMINADO con éxito."; 
         } catch (PDOException $e) {
             echo "Error en la consulta: " . $e->getMessage();
             return ["error" => "Ocurrió un error al ejecutar consulta"]; 
        }
    }
 
     /* TODO: Funcion acceso al sistema */
    public function Login() {
    $conectar = parent::Conexion();

    if (isset($_POST["enviar"])) {
        $user = $_POST["txtuser"];
        $pass = $_POST["txtpass"];

        try {
            $sql = "SP_LOGIN ?, ?";
            $query = $conectar->prepare($sql);
            $query->bindValue(1, $user);
            $query->bindValue(2, $pass);
            $query->execute();
             $messages = $query->fetch(PDO::FETCH_ASSOC);

             if ($messages['LoginStatus'] === 'SUCCESS') {
                if (is_array($messages) && count($messages) > 0) {
                    // Guardamos los datos del usuario en la sesión
                    $_SESSION["usuario_id"] = $messages["Id"];
                    $_SESSION["nombre_user"] = $messages["NombresUsuario"]; 
                    $_SESSION["correo_user"] = $messages["CorreoElectronico"];  
                    $_SESSION["rol_id"] = $messages["Id_rol"]; 
                    $_SESSION["nombre_rol"] = $messages["NombreRol"];   

                    // Redirigimos al usuario a la vista de inicio
                    header("Location: views/home/");
                    exit();
                } else {
                    $_SESSION["mensaje"] = "Error: credenciales incorrectas";
                    header("Location: index.php");
                    exit();
                } 
            } else {
                // Si hay errores, almacenarlos en variables de sesión
                $_SESSION['passErrorMessage'] = '';
                $_SESSION['genericErrorMessage'] = '';

                if ($messages['LoginStatus'] === 'PASSWORD_ERROR') {
                    $_SESSION['passErrorMessage'] = 'Contraseña incorrecta';
                } elseif ($messages['LoginStatus'] === 'USER_NOT_FOUND') {
                    $_SESSION['passErrorMessage'] = 'Usuario no encontrado';
                } else {
                    $_SESSION['genericErrorMessage'] = 'Inicio de sesión fallido: ' . $messages['LoginStatus'];
                }

                // Redirigir de nuevo al index.php
                header("Location:".conectar::ruta());
                exit();  
            }
        } catch (PDOException $e) {
            // Almacena el mensaje de error en una variable de sesión
            $_SESSION['genericErrorMessage'] = 'Error en la consulta: ' . $e->getMessage();

            // Redirigir de nuevo al index.php
            header("Location: index.php");
            exit(); // Agrega esta línea para detener la ejecución después de la redirección
        }
    }
    }

    
    
    
}

?>