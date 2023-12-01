<?php 
require_once("../config/conexion.php");
require_once("../models/Estudiante.php");

$estdiante=new Estudiante();

switch($_GET['enpoint']){
   /*TODO:Listar Libros*/
    case 'list_studen':
    $datos=$estdiante->liststuden();
    $data=Array();
    foreach($datos as $filas){
        $sub_array=array();
        $sub_array[]=$filas["Codigo"];
        $sub_array[]=$filas["Nombres"];
        $sub_array[]=$filas["Apellidos"];
        $sub_array[]=$filas["Grado_nombre"]; 
        $sub_array[]=$filas["Seccion_nombre"];
        $sub_array[]=$filas["NivelEducacional"];  
        $sub_array[]=$filas["Direccion"];
        $sub_array[]=$filas["Telefono"]; 
        $sub_array[]=$filas["Email"]; 
        $sub_array[]=$filas["Genero"];
        $sub_array[]=$filas["FechaNacimiento"]; 
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

    case 'list_studen_id':
    $datos=$estdiante->list_studen_id($_POST["estudiante_id"]);
         if(is_array($datos)==true and count($datos)>0){  
            foreach($datos as $row){
                $output["id"]=$row["Id"]; 
                $output["codigo"]=$row["Codigo"];  
                $output["nombre"]=$row["Nombres"];
                $output["apellido"]=$row["Apellidos"];
                $output["grado"]=$row["Id_grado"];
                $output["seccion"]=$row["Id_seccion"];
                $output["direccion"]=$row["Direccion"];
                $output["tel"]=$row["Tel"];
                $output["correo"]=$row["Email"];
                $output["genero"]=$row["Genero"];
                $output["nacimiento"]=$row["FechaNacimiento"];
                $output["estado_"]=$row["Estado"];  
            } 
            echo json_encode($output); 
        }
    break;

    case 'get_grados':
    $datos=$estdiante->list_comb_grados();
    if (is_array($datos) == true and count($datos) > 0) {
        $html = "<option value=''>Seleccionar</option>";
        foreach ($datos as $row) {
          $html .= "<option value='" . $row['Id'] . "'>" . $row['Nombres'] . "</option>";
        }
        echo $html;
    }
    break;

    case 'get_secciones':
    $datos=$estdiante->list_comb_secciones();
    if (is_array($datos) == true and count($datos) > 0) {
        $html = "<option value=''>Seleccionar</option>";
        foreach ($datos as $row) {
          $html .= "<option value='" . $row['Id'] . "'>" . $row['Nombres'] . "</option>";
        }
        echo $html;
    }
    break;

      
    case 'save_and_update_studen':
    /* TODO: Guardar cuando el ID este vacio y actualizar cuando venga ID*/
    if(empty($_POST["estudiante_id"])){ //insertar
      $estdiante->insert_studen(
        $_POST["codigo"],
        $_POST["nombre"],
        $_POST["apellido"],
        $_POST["grado_id"], 
        $_POST["seccion_id"], 
        $_POST["direccion"],
        $_POST["tel"],
        $_POST["correo"], 
        $_POST["genero"],
        $_POST["nacimiento"], 
        $_POST["estado"]);   

      }else{
        $estdiante->update_studen(        
        $_POST["estudiante_id"],    
        $_POST["codigo"],
        $_POST["nombre"],
        $_POST["apellido"],
        $_POST["grado_id"], 
        $_POST["seccion_id"],
        $_POST["direccion"],
        $_POST["tel"],
        $_POST["correo"], 
        $_POST["genero"],
        $_POST["nacimiento"], 
        $_POST["estado"]);   
     }
    break;
    
    case 'delete': 
    $estdiante->delete_studen($_POST["estudiante_id"]);     
    break;

    /*TODO:Alumnos - Prestamos*/
    case 'list_studens_prestamos':
    $datos=$estdiante->list_studen_id($_POST["estudiante_id"]);
         if(is_array($datos)==true and count($datos)>0){  
            foreach($datos as $row){
                $output["id"]=$row["Id"]; 
                $output["codigo"]=$row["Codigo"];  
                $output["nombres"]=$row["Nombres"]." ".$row["Apellidos"];
                 $output["grado_id"]=$row["Id_grado"];
                $output["grado"]=$row["Grado_nombre"];
                $output["seccion_id"]=$row["Id_seccion"];
                $output["seccion"]=$row["Seccion_nombre"]; 
                $output["direccion"]=$row["Direccion"];
                $output["telefono"]=$row["Tel"];
                $output["correo"]=$row["Email"];
                $output["genero"]=$row["Genero"];
                $output["nacimiento"]=$row["FechaNacimiento"];
                $output["estado_"]=$row["Estado"];  
            } 
            echo json_encode($output); 
        }
    break;
    /*TODO:Alumnos - Prestamos*/
    case 'get_alumnos':
    $datos=$estdiante->liststuden();
    if (is_array($datos) == true and count($datos) > 0) {
        $html = "<option value=''>Seleccionar</option>";
        foreach ($datos as $row) {
          $html .= "<option value='" . $row['Id'] . "'>" . $row['Nombres'] .' '. $row['Apellidos'] . "</option>";
        }
        echo $html;
    }
    break;




    

}

?>