<?php 
require_once("../config/conexion.php");
require_once("../models/Categoria.php");

$categoria=new Categoria();

switch($_GET['enpoint']){
   /*TODO:Listar categorias*/
    case 'list_categorys':
    $datos=$categoria->list_category();
    $data=Array();
    foreach($datos as $filas){
        $sub_array=array();
        $sub_array[]=$filas["Nombres"];  
        $sub_array[]=$filas["Descripcion"];  
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

    case 'list_category_id':
    $datos=$categoria->list_category_id($_POST["id_categoria"]);
         if(is_array($datos)==true and count($datos)>0){  
            foreach($datos as $row){
              $output["id"]=$row["Id"]; 
                $output["nombre"]=$row["Nombres"];  
                $output["descripcion"]=$row["Descripcion"]; 
                $output["estado"]=$row["Estado"];
            }
            echo json_encode($output); 
        }
    break; 
 
    case 'save_and_update_categories':
    /* TODO: Guardar cuando el ID este vacio y actualizar cuando venga ID*/
    if(empty($_POST["id_categoria"])){ //insertar
      $categoria->insert_category(
        $_POST["nombres"],
        $_POST["descripcion"],  
        $_POST["estado"]);  
      }else{
        $categoria->update_category(        
        $_POST["id_categoria"],   
        $_POST["nombres"], 
        $_POST["descripcion"], 
        $_POST["estado"]);  
     }       
    break;
    
    case 'delete': 
    $categoria->delete_category($_POST["id_categoria"]);     
    break;
    

}

?>