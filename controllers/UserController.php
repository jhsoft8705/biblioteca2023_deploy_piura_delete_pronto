<?php 
require_once("../config/conexion.php");
require_once("../models/Usuario.php");

$usuario=new Usuario();

switch($_GET['enpoint']){
   /*TODO:Listar Libros*/
    case 'list_user':
    $datos=$usuario->listuser();
    $data=Array();
    foreach($datos as $filas){
        $sub_array=array();
        $sub_array[]=$filas["NombresUsuario"];
        $sub_array[]=$filas["CorreoElectronico"];
        $sub_array[]=$filas["Contrasena"];
        $sub_array[]=$filas["NombreRol"]; 
        $sub_array[]=$filas["Estado"]; 
        $sub_array[]='<button type="button" onClick="editar('.$filas["Id"].')" id="'.$filas["Id"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
        $sub_array[]='<button type="button" onClick="eliminar('.$filas["Id"].')" id="'.$filas["Id"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
        $data[] = $sub_array;
    }
    $results=array(
        "SEcho"=>1,
        "iTotalrecords"=>count($data),
        "iTotaldisplayRecords"=>count($data),
        "aaData"=>$data,);
       //Imprimimos JSON
       echo json_encode($results); 
    break;  

    case 'list_user_id':
    $datos=$usuario->list_user_id($_POST["usuario_id"]);
         if(is_array($datos)==true and count($datos)>0){  
            foreach($datos as $row){
                $output["id"]=$row["Id"];   
                $output["nombre"] = $row["NombresUsuario"];
                $output["numero_documento"] = $row["NumeroDocumento"];
                $output["telefono"] = $row["Telefono"];
                $output["correo"] = $row["CorreoElectronico"];
                $output["pass"] = $row["Contrasena"];
                $output["rol_id"] = $row["Id_rol"];
                $output["nombre_rol"] = $row["NombreRol"];
                $output["descripcion_rol"] = $row["Descripcion"];
                $output["direccion"] = $row["Direccion"];
                $output["genero"] = $row["Genero"];
                $output["estado"] = $row["Estado"];
                $output["fecha_registro"] = $row["FechaRegistro"];
            }
            echo json_encode($output); 
        }
    break;

    case 'get_roles':
    $datos=$usuario->list_comb_roles();
    if (is_array($datos) == true and count($datos) > 0) {
        $html = "<option value=''>Seleccionar</option>";
        foreach ($datos as $row) {
          $html .= "<option value='" . $row['Id'] . "'>" . $row['NombreRol'] . "</option>";
        }
        echo $html;
    }
    break;
    
    case 'update_profile':
        $usuario->update_perfil(
        $_POST["usuario_id"], 
        $_POST["nombres"],
        $_POST["documento"],
        $_POST["telefono"],
        $_POST["direccion"] );  
    break;

    case 'change_password':
        $result=$usuario->update_change_password(
        $_POST["user_id"], 
        $_POST["password"], 
        $_POST["new_password"]  
      );
      echo json_encode(["Mensaje" => $result]);
      break;
    break;
  

    case 'save_and_update_user':
    /* TODO: Guardar cuando el ID este vacio y actualizar cuando venga ID*/
    if(empty($_POST["usuario_id"])){ //insertar
      $usuario->insert_user(
        $_POST["nombre"],
        $_POST["correo"],
        $_POST["pass"],
        $_POST["rol_id"], 
        $_POST["estado"]);   

      }else{
        $usuario->update_user(        
        $_POST["usuario_id"],
        $_POST["nombre"],
        $_POST["correo"],
        $_POST["pass"],
        $_POST["rol_id"], 
        $_POST["estado"]);   
     }
    break;
    
    case 'delete': 
    $usuario->delete_user($_POST["usuario_id"]);     
    break;
    

}

?>