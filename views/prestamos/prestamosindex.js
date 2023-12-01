function init() {
  $("#form_mantenimiento").on("submit", function (e) {
    //hacemos referencia al formulario por ID
    save_user_and_update(e);
  });
}

$(document).ready(function () {
  /* TODO: Listar informacion en el datatable js */
  $("#tabla_prestamos").DataTable({
    aProcessing: true,
    aServerSide: true,
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5", "print"],
    ajax: {
      url: "../../controllers/PrestamoController.php?enpoint=listar_prestamo",
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
});

function ver_doc(Id, Id_estudiante) { 
  var url =   "../view_prestamo/?p=" +  Id + "&a=" + encodeURIComponent(Id_estudiante);
  //window.location.href = url;
  window.open(url, '_blank');

 
}

function editar(Id, Id_estudiante) {
  $.post(
    "../../controllers/StudentController.php?enpoint=list_studen_id",
    { estudiante_id: Id_estudiante },
    function (data) {
      console.log(data);
      // Verificar si la respuesta no está vacía antes de intentar analizarla
      if (data.trim() !== "") {
        // Convertir a data a formato JSON
        var parsedData = JSON.parse(data);
        console.log(parsedData);
        // Aquí puedes agregar lógica para procesar la data recibida
        // Redireccionar con el ID y otros datos
        var url =
          "../prestamos-edit?id=" +
          Id +
          "&id_student=" +
          encodeURIComponent(parsedData.id);
        window.location.href = url;
      } else {
        console.error("La respuesta de la solicitud AJAX está vacía.");
      }
    }
  );
}

function devolver_libros(Id, Total) {
  Swal.fire({
    title: "Confirmar devolución de " + Total + " libros",
    text: "¿Está seguro de devolver los libros del préstamo N° " + Id + "?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, devolver!",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "../../controllers/PrestamoController.php?enpoint=devolver_prestamo",
        { prestamo_id: Id },
        function (data) {
          console.log(data); //Mostrar posibles errores en la consola
          Swal.fire({
            icon: "success",
            title: "Devolución exitosa",
            text: "Los libros han sido devueltos exitosamente.",
            footer: '<a href="../devoluciones">Ver devoluciones</a>',
          });
          $("#tabla_prestamos").DataTable().ajax.reload();
        }
      );
    }
  });
}

function eliminar(Id) {
  console.log(Id);
  //Mostrar un mensaje de confirmación al usuario utilizando SweetAlert
  swal
    .fire({
      title: "Eliminar registro",
      text: "¿Está seguro que desea eliminar este registro?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    })
    .then((result) => {
      if (result.value) {
        //Eliminar el registro utilizando una solicitud POST al controlador correspondiente
        $.post(
          "../../controllers/CONTROLLER.php?enpoint=delete",
          { usuario_id: Id },
          function (data) {
            console.log(data); //Mostrar posibles errores en la consola
          }
        );
        //Recargar la tabla después de eliminar el registro
        $("#tabla_usuarios").DataTable().ajax.reload();
        //Mostrar un mensaje de éxito al usuario utilizando SweetAlert
        swal.fire({
          title: "Registro eliminado",
          text: "El registro ha sido eliminado satisfactoriamente.",
          icon: "success",
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Aceptar",
        });
      }
    });
}
/*TODO:Funcion para abrir modalbtn_nuevo_registro y registrar*/
$(document).on("click", "#btn_nuevo_registrco", function () {
  /* TODO: Limpiar informacion */
  $("#usuario_id").val("");
  $("#nombre").val("");
  $("#correo").val("");
  $("#pass").val("");
  $("#rol_id").val("");
  $("#estado").val("");
  $("#lblnombre").html("Registrar Nuevo Usuario");
  $("#lblbtn").html("Registrar");
  $("#form_mantenimiento")[0].reset();
  /* TODO: Mostrar Modal */
  $("#modal_mantenimiento").modal("show");
});

init();
