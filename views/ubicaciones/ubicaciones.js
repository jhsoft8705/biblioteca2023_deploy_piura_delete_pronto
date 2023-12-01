
function init(){
  $("#form_mantenimiento").on("submit",function(e){//hacemos referencia al formulario por ID
    save_location_and_update(e);
  });
} 
 
function save_location_and_update(e) {
  e.preventDefault(); 
  var id_ubicacion = $("#id_ubicacion").val();
  var nombre = $("#nombre").val();
  var stank = $("#stank").val();
  var referencia = $("#referencia").val();
  var estado = $("#estado").val(); 

   if (nombre === "") {
    swal.fire({
      title: "Error",
      text: "El campo Nombre es obligatorio",
      icon: "error",
    });
    return;
  } 
  if (stank === "") {
    swal.fire({
      title: "Error",
      text: "El campo Stank es obligatorio",
      icon: "error",
    });
    return;
  } 
  if (referencia === "") {
    swal.fire({
      title: "Error",
      text: "El campo Referencia es obligatorio",
      icon: "error",
    });
    return;
  } 
  if (estado === "") {
    swal.fire({
      title: "Error",
      text: "Debes seleccionar un Estado",
      icon: "error",
    });
    return;
  } 
  if (isNaN(stank) || parseInt(stank) <= 0) {
    swal.fire({
      title: "Error",
      text: "El stank debe ser un número positivo",
      icon: "error",
    });
    return;
  }   
  var formData = new FormData($("#form_mantenimiento")[0]);
  $.ajax({
    url: "../../controllers/LocationController.php?enpoint=save_and_update_locations",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      $("#tabla_ubicaciones").DataTable().ajax.reload();
      $("#modal_mantenimiento").modal("hide");
      console.log(data);
      swal.fire({
        title: "Registro Exitoso",
        text: "La operación se realizó correctamente",
        icon: "success",
      });
    },
  });
}


$(document).ready(function () { 
  /* TODO: Listar informacion en el datatable js */
  $("#tabla_ubicaciones").DataTable({
    aProcessing: true,
    aServerSide: true,
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5" ],
    ajax: {
      url: "../../controllers/LocationController.php?enpoint=list_locations",
      type: "post",
      data: { true: true },
    },
    bDestroy: true,
    responsive: true,
    bInfo: true,
    iDisplayLength: 5,
    order: [[0, "desc"]],
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });
 
});


function editar(Id) { 
  $.post("../../controllers/LocationController.php?enpoint=list_location_id", {id_ubicacion: Id}, function(data){
      console.log(data); 
      data=JSON.parse(data);//Convertir a data a formato JSON 
      $('#id_ubicacion').val(data.id); 
      $('#nombre').val(data.nombre); 
      $('#stank').val(data.stank);
      $('#referencia').val(data.referencia);
      $('#estado').val(data.estado);

   });
   $('#lbltitulo').html('Actualizar Ubicación');

  $('#lblbtn').html('Actualizar'); 
  $('#modal_mantenimiento').modal('show'); 
 }

 function eliminar(Id){
  console.log(Id); 
//Mostrar un mensaje de confirmación al usuario utilizando SweetAlert
swal.fire({
  title: "Eliminar registro",
  text: "¿Está seguro que desea eliminar este registro?",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Sí, eliminar",
  cancelButtonText: "Cancelar"
}).then((result) => {
  if (result.value) {
    //Eliminar el registro utilizando una solicitud POST al controlador correspondiente
    $.post("../../controllers/LocationController.php?enpoint=delete", {id_ubicacion: Id}, function(data){
      console.log(data); //Mostrar posibles errores en la consola
    
    });
    //Recargar la tabla después de eliminar el registro
    $('#tabla_ubicaciones').DataTable().ajax.reload();
    //Mostrar un mensaje de éxito al usuario utilizando SweetAlert
    swal.fire({
      title: "Registro eliminado",
      text: "El registro ha sido eliminado satisfactoriamente.",
      icon: "success",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "Aceptar"
    });
  }
});
}
  /*TODO:Funcion para abrir modalbtn_nuevo_registro y registrar*/
$(document).on("click","#btn_nuevo_registro",function(){
    /* TODO: Limpiar informacion */
    $('#id_ubicacion').val('');
    $('#nombre').val('');
    $('#stank').val('');
    $('#referencia').val('');
    $('#estado').val('');  
    $('#lbltitulo').html('Registrar Nueva Ubicación');
    $('#lblbtn').html('Registrar');
    $("#form_mantenimiento")[0].reset();
    /* TODO: Mostrar Modal */
    $('#modal_mantenimiento').modal('show');
 
 });   



 init();