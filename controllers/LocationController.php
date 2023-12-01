<?php 
require_once("../config/conexion.php");
require_once("../models/Ubicacion.php");

$ubicacion=new Ubicacion();

switch($_GET['enpoint']){
   /*TODO:Listar ubicacions*/
    case 'list_locations':
    $datos=$ubicacion->list_location();
    $data=Array();
    foreach($datos as $filas){
        $sub_array=array();
        $sub_array[]=$filas["NombreUbicacion"];
        $sub_array[]=$filas["NumeroStank"]; 
        $sub_array[]=$filas["Referencia"];
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

    case 'list_location_id':
    $datos=$ubicacion->list_location_id($_POST["id_ubicacion"]);
         if(is_array($datos)==true and count($datos)>0){  
            foreach($datos as $row){
              $output["id"]=$row["Id"]; 
                $output["nombre"]=$row["NombreUbicacion"];  
                $output["stank"]=$row["NumeroStank"];
                $output["referencia"]=$row["Referencia"]; 
                $output["estado"]=$row["Estado"];
            } 
            echo json_encode($output); 
        }
    break; 
 
    case 'save_and_update_locations':
    /* TODO: Guardar cuando el ID este vacio y actualizar cuando venga ID*/
    if(empty($_POST["id_ubicacion"])){ //insertar
      $ubicacion->insert_location(
        $_POST["nombre"],
        $_POST["stank"],
        $_POST["referencia"],
        $_POST["estado"]);  
      }else{
        $ubicacion->update_location(        
        $_POST["id_ubicacion"],   
        $_POST["nombre"],
        $_POST["stank"],
        $_POST["referencia"],
        $_POST["estado"]);   
     }       
    break;
    
    case 'delete': 
    $ubicacion->delete_location($_POST["id_ubicacion"]);     
    break;
    

}

?>