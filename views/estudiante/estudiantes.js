
function init(){
  $("#form_mantenimiento").on("submit",function(e){//hacemos referencia al formulario por ID
    save_studen_and_update(e);
  });
} 


function save_studen_and_update(e) {
  e.preventDefault(); 
  var estudiante_id = $("#estudiante_id").val();
  var codigo = $("#codigo").val();
  var nombre = $("#nombre").val();
  var apellido = $("#apellido").val();
  var grado_id = $("#grado_id").val();
  var seccion_id = $("#seccion_id").val();
  var direccion = $("#direccion").val();
  var tel = $("#tel").val();
  var correo = $("#correo").val();
  var genero = $("#genero").val();
  var nacimiento = $("#nacimiento").val();
  var estado = $("#estado").val();

  if (codigo === "") {
    swal.fire({
      title: "Error",
      text: "El campo codigo es obligatorio",
      icon: "error",
    });
    return;
  } 
  if (nombre === "") {
    swal.fire({
      title: "Error",
      text: "El campo nombre es obligatorio",
      icon: "error",
    });
    return;
  } 
  if (apellido === "") {
    swal.fire({
      title: "Error",
      text: "El campo Apellidos es obligatorio",
      icon: "error",
    });
    return;
  } 
  if (grado_id === "") {
    swal.fire({
      title: "Error",
      text: "Debes seleccionar un Grado",
      icon: "error",
    });
    return;
  } 
  if (seccion_id === "") {
    swal.fire({
      title: "Error",
      text: "Debes seleccionar una sección",
      icon: "error",
    });
    return;
  }  
  if (direccion === "") {
    swal.fire({
      title: "Error",
      text: "El campo dirección es obligatorio",
      icon: "error",
    });
    return;
  } 
  if (tel === "") {
    swal.fire({
      title: "Error",
      text: "El campo teléfono es obligatorio",
      icon: "error",
    });
    return;
  } 
  if (correo === "") {
    swal.fire({
      title: "Error",
      text: "El campo correo electrónico es obligatorio",
      icon: "error",
    });
    return;
  } 
  if (genero === "") {
    swal.fire({
      title: "Error",
      text: "Debes seleccionar una genero",
      icon: "error",
    });
    return;
  }  
  if (nacimiento === "") {
    swal.fire({
      title: "Error",
      text: "El campo Fecha. Nacimiento es obligatorio",
      icon: "error",
    });
    return;
  } 
  if (estado === "") {
    swal.fire({
      title: "Error",
      text: "Debes seleccionar un estado",
      icon: "error",
    });
    return;
  }  

  var formData = new FormData($("#form_mantenimiento")[0]);
  $.ajax({
    url: "../../controllers/StudentController.php?enpoint=save_and_update_studen",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      $("#tabla_estudiantes").DataTable().ajax.reload();
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
  $("#tabla_estudiantes").DataTable({
    aProcessing: true,
    aServerSide: true,
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5","print"],
    ajax: {
      url: "../../controllers/StudentController.php?enpoint=list_studen",
      type: "post",
      data: { Id: true },
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

/*TODO:llistar grado de formulario */
$.post(
  "../../controllers/StudentController.php?enpoint=get_grados",
  { true: true },
  function (data) {
    $("#grado_id").html(data);
  }
); 
/*TODO:llistar seccion de formulario */
$.post(
  "../../controllers/StudentController.php?enpoint=get_secciones",
  { true: true },
  function (data) {
    $("#seccion_id").html(data);
  }
); 
});




function editar(Id) { 
  $.post("../../controllers/StudentController.php?enpoint=list_studen_id", {estudiante_id: Id}, function(data){
      console.log(data); 
      data=JSON.parse(data);//Convertir a data a formato JSON
      $('#estudiante_id').val(data.id); 
      $('#codigo').val(data.codigo); 
      $('#nombre').val(data.nombre);
      $('#apellido').val(data.apellido);
      $('#grado_id').val(data.grado).trigger('change');
      $('#seccion_id').val(data.seccion).trigger('change'); 
      $('#direccion').val(data.direccion); 
      $('#tel').val(data.tel); 
      $('#correo').val(data.correo); 
      $('#genero').val(data.genero).trigger('change');
      $('#nacimiento').val(data.nacimiento);  
      $('#estado').val(data.estado_).trigger('change'); 
      console.log(data.tel) 
   });
   $('#lblnombre').html('Actualizar Alumno');

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
    $.post("../../controllers/StudentController.php?enpoint=delete", {estudiante_id: Id}, function(data){
      console.log(data); //Mostrar posibles errores en la consola
    
    });
    //Recargar la tabla después de eliminar el registro
    $('#tabla_estudiantes').DataTable().ajax.reload();
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
    $('#estudiante_id').val('');
    $('#codigo').val('');
    $('#nombre').val('');
    $('#grado_id').val('');
    $('#seccion_id').val('');
    $('#direccion').val('');
    $('#tel').val('');
    $('#correo').val('');
    $('#genero').val('');
    $('#nacimiento').val('');
    $('#estado').val('');  
    $('#lblnombre').html('Registrar Nuevo Estudiante');
    $('#lblbtn').html('Registrar');
    $("#form_mantenimiento")[0].reset();
    /* TODO: Mostrar Modal */
    $('#modal_mantenimiento').modal('show');
 
 });   



 init();