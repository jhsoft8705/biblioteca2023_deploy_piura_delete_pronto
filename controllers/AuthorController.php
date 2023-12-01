<?php 
require_once("../config/conexion.php");
require_once("../models/Autor.php");

$autor=new Autor();

switch($_GET['enpoint']){
   /*TODO:Listar autors*/
    case 'list_authors':
    $datos=$autor->list_author();
    $data=Array();
    foreach($datos as $filas){
        $sub_array=array();
        $sub_array[]=$filas["Nombre"];
        $sub_array[]=$filas["Nacionalidad"]; 
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

    case 'list_author_id':
    $datos=$autor->list_author_id($_POST["id_author"]);
         if(is_array($datos)==true and count($datos)>0){  
            foreach($datos as $row){
              $output["id"]=$row["Id"]; 
                $output["nombre"]=$row["Nombre"];  
                $output["nacionalidad"]=$row["Nacionalidad"];
                $output["fecha_nacimiento"]=$row["FechaNacimiento"]; 
                $output["estado"]=$row["Estado"];
            }
            echo json_encode($output); 
        }
    break; 
 
    case 'save_and_update_books':
    /* TODO: Guardar cuando el ID este vacio y actualizar cuando venga ID*/
    if(empty($_POST["id_author"])){ //insertar
      $autor->insert_author(
        $_POST["nombres"],
        $_POST["nacionalidad"],
        $_POST["nacimiento"],
        $_POST["estado"]);  
      }else{
        $autor->update_author(        
        $_POST["id_author"],   
        $_POST["nombres"],
        $_POST["nacionalidad"],
        $_POST["nacimiento"],
        $_POST["estado"]);  
     }       
    break;
    
    case 'delete': 
    $autor->delete_author($_POST["id_author"]);     
    break;
    

}

?>