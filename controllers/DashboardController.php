<?php 
require_once("../config/conexion.php");
require_once("../models/Dashboard.php");

$dashboard=new Dashboard();

switch($_GET['enpoint']){ 
    case 'dona':
    $datos=$dashboard->get_dona();
    $data = array();
        foreach($datos as $row){
         $data[]=$row;  
        }
    echo json_encode($data);  
    break;    
   
    case 'get_op_recientes':
    $datos=$dashboard->get_op_recientes();
       foreach($datos as $row){ 
            ?>
            <tr>
            <td scope="row"><a href="#"><?php echo $row["Id"];?></a></td>
            <td><?php echo $row["solicitante"];?></td>
            <td><a href="#" class="text-primary"><?php echo $row["NombresUsuario"];?></a></td>
            <td><?php echo $row["Total"];?></td> 
            <?php
            if ($row["Estado"] == 'PRESTADO'){
            ?>
            <td><span class="badge bg-danger"><?php echo $row["Estado"];?></span></td> 
            <?php
            }else{
            ?>
             <td><span class="badge bg-success"><?php echo $row["Estado"];?></span></td>
             </tr>
            <?php
            } 
        } 
         break; 

  

    
}

?>