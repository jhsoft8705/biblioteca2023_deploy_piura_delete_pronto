
function init(){
  $("#form_mantenimiento").on("submit",function(e){//hacemos referencia al formulario por ID
    save_rol_and_update(e);
  });
} 
 
function save_rol_and_update(e) {
  e.preventDefault(); 
  var id = $("#id_rol").val();
  var txtnombre = $("#nombre").val();
  var descripcion = $("#descripcion").val(); 
  var estado = $("#estado").val(); 

   if (txtnombre === "") {
    swal.fire({
      title: "Error",
      text: "El campo Nombre es obligatorio",
      icon: "error",
    });
    return;
  }  
  var estado = $("#estado").val(); 

  if (descripcion === "") {
   swal.fire({
     title: "Error",
     text: "El campo descripción es obligatorio",
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
     
  var formData = new FormData($("#form_mantenimiento")[0]);
  $.ajax({
    url: "../../controllers/RolController.php?enpoint=save_and_update_roles",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      $("#tabla_roles").DataTable().ajax.reload();
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
  $("#tabla_roles").DataTable({
    aProcessing: true,
    aServerSide: true,
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5" ],
    ajax: {
      url: "../../controllers/RolController.php?enpoint=list_roles",
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
  $.post("../../controllers/RolController.php?enpoint=list_rol_id", {id_rol: Id}, function(data){
      console.log(data); 
      data=JSON.parse(data);//Convertir a data a formato JSON 
      $('#id_rol').val(data.id); 
      $('#nombre').val(data.nombre); 
      $('#descripcion').val(data.descripcion);  
      $('#estado').val(data.estado);
   });
   $('#lbltitulo').html('Actualizar Rol');

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
    $.post("../../controllers/RolController.php?enpoint=delete", {id_rol: Id}, function(data){
      console.log(data); //Mostrar posibles errores en la consola
    
    });
    //Recargar la tabla después de eliminar el registro
    $('#tabla_roles').DataTable().ajax.reload();
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
    $('#id_rol').val('');
    $('#nombre').val('');
    $('#descripcion').val('');
     $('#estado').val(''); 
    $('#lbltitulo').html('Registrar Nuevo Rol');
    $('#lblbtn').html('Registrar');
    $("#form_mantenimiento")[0].reset();
    /* TODO: Mostrar Modal */
    $('#modal_mantenimiento').modal('show');
 
 });   



 init();