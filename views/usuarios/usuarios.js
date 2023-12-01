
function init(){
  $("#form_mantenimiento").on("submit",function(e){//hacemos referencia al formulario por ID
    save_user_and_update(e);
  });
} 


function save_user_and_update(e) {
  e.preventDefault(); 
  var id = $("#usuario_id").val();
  var nombre = $("#nombre").val();
  var correo = $("#correo").val();
  var pass = $("#pass").val();
  var rol_id = $("#rol_id").val();
  var estado = $("#estado").val(); 

   if (nombre === "") {
    swal.fire({
      title: "Error",
      text: "El campo nombre es obligatorio",
      icon: "error",
    });
    return;
  } 
  if (correo === "") {
    swal.fire({
      title: "Error",
      text: "Debes ingresar un correo electrónico",
      icon: "error",
    });
    return;
  } 
  if (pass === "") {
    swal.fire({
      title: "Error",
      text: "Debes ingresar una contraseña",
      icon: "error",
    });
    return;
  } 
  if (rol_id === "") {
    swal.fire({
      title: "Error",
      text: "Debes seleccionar un rol",
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
    url: "../../controllers/UserController.php?enpoint=save_and_update_user",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      $("#tabla_usuarios").DataTable().ajax.reload();
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
  $("#tabla_usuarios").DataTable({
    aProcessing: true,
    aServerSide: true,
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5","print"],
    ajax: {
      url: "../../controllers/UserController.php?enpoint=list_user",
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

/*TODO:llistar periodo de formulario */
$.post(
  "../../controllers/UserController.php?enpoint=get_roles",
  { true: true },
  function (data) {
    $("#rol_id").html(data);
  }
); 
});


function editar(Id) { 
  $.post("../../controllers/UserController.php?enpoint=list_user_id", {usuario_id: Id}, function(data){
      console.log(data); 
      data=JSON.parse(data);//Convertir a data a formato JSON
      $('#usuario_id').val(data.id); 
      $('#nombre').val(data.nombre); 
      $('#correo').val(data.correo);
      $('#pass').val(data.pass);
      $('#rol_id').val(data.rol_id).trigger('change');
      $('#estado').val(data.estado); 
   });
   $('#lblnombre').html('Actualizar Usuario');

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
    $.post("../../controllers/UserController.php?enpoint=delete", {usuario_id: Id}, function(data){
      console.log(data); //Mostrar posibles errores en la consola
    
    });
    //Recargar la tabla después de eliminar el registro
    $('#tabla_usuarios').DataTable().ajax.reload();
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
    $('#usuario_id').val('');
    $('#nombre').val('');
    $('#correo').val('');
    $('#pass').val('');
    $('#rol_id').val('');
    $('#estado').val(''); 
    $('#lblnombre').html('Registrar Nuevo Usuario');
    $('#lblbtn').html('Registrar');
    $("#form_mantenimiento")[0].reset();
    /* TODO: Mostrar Modal */
    $('#modal_mantenimiento').modal('show');
 
 });   



 init();