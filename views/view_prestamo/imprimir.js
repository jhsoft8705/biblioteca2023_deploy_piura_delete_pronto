var id_prestamo = $("#id_prestamo").val();
var id_alumno = $("#id_alumno").val();
  

$(document).ready(function () {
  /* TODO:STUDENT */
  $.post(
    "../../controllers/StudentController.php?enpoint=list_studens_prestamos",
    { estudiante_id: id_alumno },
    function (data) {
      data = JSON.parse(data);
      $("#txtnombres").text(data.nombres);
      $("#txtcodigo").text(data.codigo);
      $("#txtgrado").text(data.grado);
      $("#txtsession").text(data.seccion);
      $("#txtdireccion").text(data.direccion);
      $("#txtemail").text(data.correo);
      $("#txtetelefono").text(data.telefono);
    }
  );
  $.post(
    "../../controllers/PrestamoController.php?enpoint=lista_prestamo_id",
    { prestamo_id: id_prestamo },
    function (data) {
      console.log(data);
      data = JSON.parse(data); //Convertir a data a formato JSON
      $("#txtprestamo").text(data.id);
      $("#txtuser").text(data.nombre_user);
      $("#txt_fecha_prestamo").text(data.fecha_prestamo);
      $("#txt_fecha_devol").text(data.fecha_devolucion);
      $("#txttotal").text(data.total);
      $("#txtcomen").text(data.comentario);
      $("#txtestado").text(data.estado);
    }
  );

/* TODO: DATATABLE */
$("#tabla_imprimir").DataTable({
  paging: false,  // Desactiva la paginación
  searching: false,  // Desactiva el buscador
  aProcessing: true,
  aServerSide: true,
  dom: "Bfrtip",
  buttons: [],
  ajax: {
      url: "../../controllers/PrestamoController.php?enpoint=listar_detalle_update",
      type: "post",
      data: { recibe_prestamo_id: id_prestamo },
  } 
});

  /* TODO:TOTALL*/
  $.post(
    "../../controllers/PrestamoController.php?enpoint=create_total_realtime_update",
    { recibe_prestamo_id: id_prestamo },
    function (data) {
      data = JSON.parse(data);
      $("#id_total").text(data.total);
      console.log(data.total);
    }
  );

 
});

function eliminar(Id){
 
}