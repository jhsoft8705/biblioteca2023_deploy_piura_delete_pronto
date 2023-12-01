var user_id = $("#variable_session_user_id_navbar").val();
console.log("EL USER ES:" + user_id);
/*TODO:*/
$(document).ready(function () {
  /*TOOD:Prestamo sin confirmar*/ 
  $.post(
    "../../controllers/PrestamoController.php?enpoint=create_temporary_prestamo",
    { true: true },
    function (data) {
      data = JSON.parse(data);
      $("#id_prestamo").val(data.id_prestamo);
      var id_prestamo_hidden = data.id_prestamo;

      /*TOOD:Actualizar Stock libros*/
      $.post(
        "../../controllers/PrestamoController.php?enpoint=update_stock_libros",
        { true: true },
        function (data) {
          console.log(data);
        }
      );
      /* TODO:STUDENT CBX*/
      $.post(
        "../../controllers/StudentController.php?enpoint=get_alumnos",
        { true: true },
        function (data) {
          $("#alumno_id").html(data);
          $("#alumno_id").change(function () {
            $("#codigo").val("");
            $("#grado").val("");
            $("#seccion").val("");
            $("#direccion").val("");
            $("#correo").val("");
            $("#telefono").val("");
          });
        }
      );
      $("#alumno_id").change(function () {
        $("#alumno_id").each(function () {
          xyz = $(this).val(); //Id del proveedor recolectado
          $.post(
            "../../controllers/StudentController.php?enpoint=list_studens_prestamos",
            { estudiante_id: xyz },
            function (data) {
              data = JSON.parse(data);
              $("#codigo").val(data.codigo);
              $("#grado").val(data.grado);
              $("#seccion").val(data.seccion);
              $("#direccion").val(data.direccion);
              $("#correo").val(data.correo);
              $("#telefono").val(data.telefono);
            }
          );
        });
      });

      /* TODO: BOOK CBX*/
      $.post(
        "../../controllers/BookController.php?enpoint=get_books",
        { true: true },
        function (data) {
          $("#libro_id").html(data);
          $("#libro_id").change(function () {
            $("#autor").val("");
            $("#categoria").val("");
            $("#cantidad").val("");
          });
        }
      );
      //Subsucargar inf
      $("#libro_id").change(function () {
        $("#libro_id").each(function () {
          book_id = $(this).val(); //Id del proveedor recolectado
          $.post(
            "../../controllers/BookController.php?enpoint=list_books_prestamos",
            { id_libro: book_id },
            function (data) {
              //Parseamos la data recolectada
              data = JSON.parse(data);
              console.log(data);
              $("#autor").val(data.autor);
              $("#categoria").val(data.categoria);
              $("#cantidad").val(data.cantidad);
              $("#publicacion").val(data.publicacion);
              $("#ubicacion").val(data.ubicacion);
            }
          );
        });
      });

      $.post(
        "../../controllers/PrestamoController.php?enpoint=create_total_realtime",
        { recibe_prestamo_id: id_prestamo_hidden },
        function (data) {
          data = JSON.parse(data);
          $("#id_total").text(data.total);
          console.log(data.total);
        }
      );

      /* TODO:DATATBLE*/
      $("#tabla_prestamos").DataTable({
        aProcessing: true,
        aServerSide: true,
        dom: "Bfrtip",
        buttons: ["copyHtml5"],
        ajax: {
          url: "../../controllers/PrestamoController.php?enpoint=listar_detalle",
          type: "post",
          data: { recibe_prestamo_id: id_prestamo_hidden },
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
          sInfoEmpty:
            "Mostrando registros del 0 al 0 de un total de 0 registros",
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
    }
  );
});

/*TODO:Eliminar*/
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
          "../../controllers/PrestamoController.php?enpoint=delete_detalle",
          { prestamo_id: Id },
          function (data) {
            console.log(data); //Mostrar posibles errores en la consola
            _default();
          }
        );
        //Recargar la tabla después de eliminar el registro
        $("#tabla_prestamos").DataTable().ajax.reload();
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

/*TODO:Registrar Detalle*/
$(document).on("click", "#btn_register_detalle", function () {
  var id_prestamo_hidden = $("#id_prestamo").val();
  var libro_id = $("#libro_id").val();
  var cantidadlibre = $("#cantidad").val();
  var cantidad = $("#Cantidad_requerida").val();

  if (libro_id === "") {
    swal.fire({
      title: "Libro no seleccionado",
      text: "Por favor, selecciona un libro para continuar.",
      icon: "error",
    });
    return;
  }

  if (parseInt(cantidadlibre) === 0) {
    swal.fire({
      title: "Error",
      text: "No hay libros disponibles para préstamo.",
      icon: "error",
    });
    return;
  }

  if (
    !cantidad.trim() ||
    isNaN(parseInt(cantidad)) ||
    parseInt(cantidad) !== 1
  ) {
    Swal.fire({
      icon: "error",
      title: "Cantidad inválida",
      text: cantidad.trim()
        ? "Por políticas de la institución, solo se permite prestar una unidad por libro "
        : "El campo de cantidad está vacío.",
    });
    return;
  }
  $.ajax({
    type: "POST",
    url: "../../controllers/PrestamoController.php?enpoint=save_datail",
    data: {
      id_prestamo: id_prestamo_hidden,
      libro_id: libro_id,
      Cantidad_requerida: cantidad,
    },
    success: function (data) {
      data = JSON.parse(data);
      Swal.fire({
        //startsWith + Comienzo del mensaje el BD SP
        title: data.Mensaje.startsWith("Detalle")
          ? "Registro Exitoso"
          : "Advertencia",
        text: data.Mensaje,
        icon: data.Mensaje.startsWith("Detalle") ? "success" : "warning",
      });
      $("#tabla_prestamos").DataTable().ajax.reload();
      _default();
      /*TODO:Reload_total*/
      $.post(
        "../../controllers/PrestamoController.php?enpoint=create_total_realtime",
        { recibe_prestamo_id: id_prestamo_hidden },
        function (data) {
          data = JSON.parse(data);
          $("#id_total").text(data.total);
          console.log(data.total);
        }
      );
    },
    error: function () {
      Swal.fire({
        title: "Error en la consulta",
        text: "Ocurrió un error en la solicitud",
        icon: "error",
      });
      // Realizar acciones adicionales en caso de error
      $("#tabla_prestamos").DataTable().ajax.reload();
      _default();
      /*TODO:Reload_total*/
      $.post(
        "../../controllers/PrestamoController.php?enpoint=create_total_realtime",
        { recibe_prestamo_id: id_prestamo_hidden },
        function (data) {
          data = JSON.parse(data);
          $("#id_total").text(data.total);
          console.log(data.total);
        }
      );
    },
  });
});

/*TODO:Limpiar*/
function _default() {
  $("#libro_id").val("");
  $("#autor").val("");
  $("#categoria").val("");
  $("#cantidad").val("");
  $("#publicacion").val("");
  $("#ubicacion").val("");
  $("#Cantidad_requerida").val("");
}

/*TODO:Cancelar Prestamo*/
$(document).on("click", "#btn_cancelar_reload", function () {
  location.reload(); //Recargar_Pagina();
});

$(document).on("click", "#btn_limpiar_detalle", function () {
  _default();
});

/*TODO: Manejo de fechas */
$(document).ready(function () {
  var today = new Date();
  var day = String(today.getDate()).padStart(2, "0");
  var month = String(today.getMonth() + 1).padStart(2, "0");
  var year = today.getFullYear();
  var todayFormatted = year + "-" + month + "-" + day;

  $("#fecha_inicio").attr("min", todayFormatted);

  $("#fecha_inicio").change(function () {
    var selectedDate = $("#fecha_inicio").val();
    $("#fecha_fin").attr("min", selectedDate);
  });

  $("#fecha_fin").change(function () {
    var endDate = $("#fecha_fin").val();
    var startDate = $("#fecha_inicio").val();
    if (endDate < startDate) {
      $("#fecha_fin").val("");
    }
  });
});

/*TODO:Registrar prestamo*/
$(document).on("click", "#btn_Registrar_prestamo", function () {
  var id_prestamo_hidden = $("#id_prestamo").val();
  var alumno_id_hidden = $("#alumno_id").val();
  var fecha_inicio = $("#fecha_inicio").val();
  var fecha_fin = $("#fecha_fin").val();
  var comentario = $("#comentario").val();

  var today = new Date();
  var fechaInicio = new Date(fecha_inicio);
  var fechaFin = new Date(fecha_fin);

  if (alumno_id_hidden === "") {
    swal.fire({
      title: "Alumno no seleccionado",
      text: "Por favor, selecciona un alumno para continuar.",
      icon: "error",
    });
    return;
  }

  if (fecha_inicio == "" || fecha_fin == "") {
    Swal.fire({
      icon: "error",
      title: "Por favor, selecciona las fechas para el prestamo.",
      text: "Verifica las fechas seleccionadas.",
    });
    return;
  }

  /*
  if (!fecha_inicio ||!fecha_fin ||fechaInicio < today || fechaFin < fechaInicio) {
    Swal.fire({
      icon: "error",
      title: "Fechas inválidas",
      text: "Verifica las fechas seleccionadas.",
    });
    return;
  }*/
  if (comentario === "") {
    swal.fire({
      title: "Sin Comentario",
      text: "Por favor, Ingresa un comentario para finalizar el prestamo",
      icon: "error",
    });
    return;
  }

  $.post(
    "../../controllers/PrestamoController.php?enpoint=save_prestamo",
    {
      id_prestamo: id_prestamo_hidden,
      alumno_id: alumno_id_hidden,
      id_usuario: user_id,
      fecha_inicio: fecha_inicio,
      fecha_fin: fecha_fin,
      comentario: comentario,
    },
    function (data) {
      data = JSON.parse(data); // Asegúrate de que la respuesta sea un objeto JSON
      if (data.error) {
        swal.fire({
          title: "Error al registrar",
          text: data.error,
          icon: "error",
        });
      } else if (data.success) {
        Swal.fire({
          icon: "success",
          title: "El Préstamo fue registrado correctamente",
          text: data.success,
          footer:
            "<a href='../view_prestamo/?p=" +
            id_prestamo_hidden +
            "&a=" +
            alumno_id_hidden +
            "' target='_blank'>¿Desea ver el documento?</a>",
          willClose: () => {
            window.location.href = "../prestamos/";
          },
        });
      } else {
        // Aquí manejas el mensaje específico
        swal.fire({
          title: "Error al registrar",
          text: data.error,
          icon: "error",
        });
      }
    }
  );
});
