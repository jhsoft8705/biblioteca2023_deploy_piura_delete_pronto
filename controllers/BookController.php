<?php 
require_once("../config/conexion.php");
require_once("../models/Libro.php");

$libro=new Libro();

switch($_GET['enpoint']){
   /*TODO:Listar Libros*/
    case 'list_books':
    $datos=$libro->listbooks();
    $data=Array();
    foreach($datos as $filas){
        $sub_array=array();
        $sub_array[]=$filas["Codigo"]; 
        $sub_array[]=$filas["Titulo"];
        $sub_array[]=$filas["Autor"];
        $sub_array[]=$filas["NombreUbicacion"];
        $sub_array[]=$filas["NumeroStank"];
        $sub_array[]=$filas["Categoria"];
        $sub_array[]=$filas["Cantidad_Libros"];    
        $sub_array[]=$filas["AnioPublicacion"];
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

    case 'list_book_id':
    $datos=$libro->list_books_id($_POST["Id"]);
         if(is_array($datos)==true and count($datos)>0){  
            foreach($datos as $row){
              $output["id"]=$row["Id"]; 
              $output["codigo"]=$row["Codigo"];  
                $output["titulo"]=$row["Titulo"];  
                $output["autor"]=$row["autor_id"];
                $output["ubicacion"]=$row["ubi_id"];
                $output["categoria"]=$row["cate_id"];
                $output["cantidad"]=$row["Cantidad_Libros"];
                $output["publicacion"]=$row["AnioPublicacion"];
                $output["estado"]=$row["Estado"];
            }
            echo json_encode($output); 
        }
    break;

    case 'get_categories':
    $datos=$libro->list_comb_categories();
    if (is_array($datos) == true and count($datos) > 0) {
        $html = "<option value=''>Seleccionar</option>";
        foreach ($datos as $row) {
          $html .= "<option value='" . $row['Id'] . "'>" . $row['Nombres'] . "</option>";
        }
        echo $html;
    }
    break;

    case 'get_authors':
    $datos=$libro->list_comb_athors();
    if (is_array($datos) == true and count($datos) > 0) {
        $html = "<option value=''>Seleccionar</option>";
        foreach ($datos as $row) {
          $html .= "<option value='" . $row['Id'] . "'>" . $row['Nombre'] .' - '.$row['Nacionalidad'] . "</option>";
        }
        echo $html;
    }
    break;

    case 'get_locations':
    $datos=$libro->list_comb_locations();
    if (is_array($datos) == true and count($datos) > 0) {
        $html = "<option value=''>Seleccionar</option>";
        foreach ($datos as $row) {
          $html .= "<option value='" . $row['Id'] . "'>" . $row['NombreUbicacion'] .' - '.$row['NumeroStank'] . "</option>";
        }
        echo $html;
    }
    break;
 
    case 'save_and_update_books':
    /* TODO: Guardar cuando el ID este vacio y actualizar cuando venga ID*/
    if(empty($_POST["id"])){ //insertar
      $libro->insert_book(
        $_POST["codigo"], 
        $_POST["titulo"],
        $_POST["autor"],
        $_POST["ubi"],
        $_POST["cate"],
        $_POST["cantidad"],
        $_POST["anio"]);    
      }else{
        $libro->update_book(        
        $_POST["id"],
        $_POST["codigo"],  
        $_POST["titulo"],
        $_POST["autor"],
        $_POST["ubi"],
        $_POST["cate"],
        $_POST["cantidad"],
        $_POST["anio"]); 
     }
    break;
    
    case 'delete': 
    $libro->delete_book($_POST["id"]);     
    break;

    /*TODO:Prestamos*/
    case 'get_books':
    $datos=$libro->listbooks();
    if (is_array($datos) == true and count($datos) > 0) {
        $html = "<option value=''>Seleccionar</option>";
        foreach ($datos as $row) {
          $html .= "<option value='" . $row['Id'] . "'>" . $row['Codigo'] .' - '.$row['Titulo'] . "</option>";
        }
        echo $html;
    }
    break;

    case 'list_books_prestamos':
    $datos=$libro->list_books_id($_POST["id_libro"]);
         if(is_array($datos)==true and count($datos)>0){  
            foreach($datos as $row){
               $output["id"]=$row["Id"]; 
               $output["codigo"]=$row["Codigo"];  
                $output["titulo"]=$row["Titulo"];  
                $output["autor"]=$row["Autor"];
                $output["ubicacion"]=$row["NombreUbicacion"];
                $output["categoria"]=$row["Categoria"];
                $output["cantidad"]=$row["Cantidad_Libros"];
                $output["publicacion"]=$row["AnioPublicacion"];
                $output["estado"]=$row["Estado"];
            }
            echo json_encode($output); 
        }
    break;
    

}

?>