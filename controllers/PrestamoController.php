<?php 
require_once("../config/conexion.php");
require_once("../models/Prestamo.php");

$prestamo=new Prestamo();

switch($_GET['enpoint']){
   /*TODO:PRESTAMOS*/
   case 'create_temporary_prestamo':
   $datos=$prestamo->Create_prestamo_temporal();
        if(is_array($datos)==true and count($datos)>0){  
           foreach($datos as $row){
               $output["id_prestamo"]=$row["Id"]; 
               $output["estado"]=$row["Estado"];  
               $output["fecha_registro"]=$row["Fecha_Registro"]; 
           }
           echo json_encode($output); 
       }
   break; 
   case 'update_stock_libros':
   $prestamo->update_reload_stock_libros();  
   break; 
   
   case 'create_total_realtime':
   $datos=$prestamo->Create_temporal_detail_total($_POST["recibe_prestamo_id"]);
        if(is_array($datos)==true and count($datos)>0){  
           foreach($datos as $row){
               $output["total"]=$row["Total"]; 
             }
           echo json_encode($output); 
       }
   break; 
   case 'create_total_realtime_update':
   $datos=$prestamo->Create_temporal_detail_total_update($_POST["recibe_prestamo_id"]);
        if(is_array($datos)==true and count($datos)>0){  
           foreach($datos as $row){
               $output["total"]=$row["Total"]; 
             }
           echo json_encode($output); 
       }
   break; 
    case 'listar_detalle':
    $datos=$prestamo->list_detail_prestamo($_POST["recibe_prestamo_id"]);
    $data=Array();
    foreach($datos as $filas){
        $sub_array=array();  
        $sub_array[]=$filas["Codigo"]; 
        $sub_array[]=$filas["Titulo"]; 
        $sub_array[]=$filas["Nombre_Categoria"]; 
        $sub_array[]=$filas["Nombre_Autor"]; 
        $sub_array[]=$filas["cantidad"];  
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
    
    case 'listar_detalle_update':
    $datos=$prestamo->list_detail_prestamo_update($_POST["recibe_prestamo_id"]);
    $data=Array();
    foreach($datos as $filas){
        $sub_array=array();  
        $sub_array[]=$filas["Codigo"]; 
        $sub_array[]=$filas["Titulo"]; 
        $sub_array[]=$filas["Nombre_Categoria"]; 
        $sub_array[]=$filas["Nombre_Autor"]; 
        $sub_array[]=$filas["cantidad"];  
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

    case 'listar_prestamo':
    $datos=$prestamo->Listar_prestamos();
    $data=Array();
    foreach($datos as $filas){
        $sub_array=array();  
        $sub_array[] = '<a href="#" onclick="ver_doc('.$filas["Id"].', '.$filas["Id_estudiante"].')">'.$filas["Codigo"].'-'.$filas["Nombres"].'-'.$filas["Apellidos"].'</a>';
        $sub_array[]=$filas["Grado"]; 
        $sub_array[]=$filas["Seccion"]; 
        $sub_array[]=$filas["FechaPrestamo"];
        $sub_array[]=$filas["FechaDevolucion"];  
        $sub_array[]=$filas["Total"]; 
        $sub_array[]=$filas["Estado"];
        $sub_array[]=$filas["NombresUsuario"]; 
        $sub_array[] = '<button type="button" onClick="editar('.$filas["Id"].', '.$filas["Id_estudiante"].')" id="'.$filas["Id"].'" class="btn btn-warning btn-icon waves-effect waves-light" data-id="'.$filas["Id"].'"><i class="ri-edit-2-line"></i></button>';
        $sub_array[] = '<button type="button" onClick="devolver_libros('.$filas["Id"].', \''.$filas["Total"].'\', \''.$filas["FechaDevolucion"].'\')" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-compass-2-line"></i></button>';
          $sub_array[]='<button type="button" onClick="eliminar('.$filas["Id"].')" id="'.$filas["Id"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class=" ri-chat-delete-fill"></i></button>';
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

    case 'lista_prestamo_id':
    $datos=$prestamo->list_prestamo_id($_POST["prestamo_id"]);
         if(is_array($datos)==true and count($datos)>0){  
            foreach($datos as $row){
                $output["id"]=$row["Id"]; 
                $output["id_estudiante"]=$row["Id_estudiante"];  
                $output["id_user"]=$row["Id_usuario"];
                $output["nombre_user"]=$row["NombresUsuario"]; 
                $output["fecha_prestamo"]=$row["FechaPrestamo"];
                $output["fecha_devolucion"]=$row["FechaDevolucion"]; 
                $output["total"]=$row["Total"];
                $output["estado"]=$row["Estado"]; 
                $output["comentario"]=$row["Comentario"]; 
            }
            echo json_encode($output); 
        }
    break;
 
    case 'save_prestamo':
    $result = $prestamo->Registrar_Prestamo(
        $_POST["id_prestamo"],
        $_POST["alumno_id"],
        $_POST["id_usuario"],
        $_POST["fecha_inicio"],
        $_POST["fecha_fin"],
        $_POST["comentario"]
    );

    if (isset($result['Mensaje'])) {
        echo json_encode(["error" => $result['Mensaje']]);
    } else {
        echo json_encode(["success" => "Exito"]);
    }
    
    break;
    
    case 'save_datail':
    $message = $prestamo->insert_detalle_prestamo(
        $_POST["id_prestamo"],
        $_POST["libro_id"], 
        $_POST["Cantidad_requerida"]
    );

    if ($message) {
        echo json_encode(["Mensaje" => $message]);
    } else {
        echo json_encode(["Mensaje" => "No se devolvió ningún mensaje"]);
    }
    break;

    case 'save_datail_update':
    $message = $prestamo->insert_detalle_prestamo_update(
        $_POST["id_prestamo"],
        $_POST["libro_id"], 
        $_POST["Cantidad_requerida"]
    );

    if ($message) {
        echo json_encode(["Mensaje" => $message]);
    } else {
        echo json_encode(["Mensaje" => "No se devolvió ningún mensaje"]);
    }
    break;
    case 'delete_detalle': 
    $prestamo->delete_detalle_prest($_POST["prestamo_id"]);     
    break;


        /*TODO:DEVOLUCIONES*/
    case 'listar_devoluciones':
    $datos=$prestamo->list_devolucion();
    $data=Array();
    foreach($datos as $filas){
        $sub_array=array();  
        $sub_array[] =$filas["Codigo"].'-'.$filas["Nombres"].'-'.$filas["Apellidos"];
        $sub_array[]=$filas["Grado"]; 
        $sub_array[]=$filas["Seccion"]; 
        $sub_array[]=$filas["FechaDevolucionFinal"];  
        $sub_array[]=$filas["Total"]; 
        $sub_array[]=$filas["Estado"];
        $sub_array[]=$filas["NombresUsuario"]; 
        $sub_array[] = '<button type="button" onClick="ver_doc('.$filas["Id"].', '.$filas["Id_estudiante"].')" id="'.$filas["Id"].'" class="btn btn-warning btn-icon waves-effect waves-light" data-id="'.$filas["Id"].'"><i class=" ri-eye-fill"></i></button>';
           $sub_array[]='<button type="button" onClick="z('.$filas["Id"].')" id="'.$filas["Id"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class=" ri-chat-delete-fill"></i></button>';
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

    case 'devolver_prestamo': 
    $prestamo->marcar_devuelto($_POST["prestamo_id"]);     
    break;
     

}

?>