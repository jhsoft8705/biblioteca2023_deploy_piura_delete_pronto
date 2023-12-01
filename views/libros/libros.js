function init() {
  $("#form_libros").on("submit", function (e) {
    //hacemos referencia al formulario por ID
    save_book_and_update(e);
  });
}

/*TOOD:Sava y udate*/ 
function save_book_and_update(e) {
  e.preventDefault();
  var id = $("#id").val();
  var codigo = $("#codigo").val();
  var titulo = $("#titulo").val();
  var autor = $("#autor").val();
  var ubicacion = $("#ubi").val();
  var categoria = $("#cate").val();
  var cantidad = $("#cantidad").val();
  var anio = $("#anio").val();

  if (codigo === "") {
    swal.fire({
      title: "Error",
      text: "El campo código es obligatorio",
      icon: "error",
    });
    return;
  }
  if (titulo === "") {
    swal.fire({
      title: "Error",
      text: "El campo título es obligatorio",
      icon: "error",
    });
    return;
  }
  if (autor === "") {
    swal.fire({
      title: "Error",
      text: "Debes seleccionar un Autor",
      icon: "error",
    });
    return;
  }
  if (ubicacion === "") {
    swal.fire({
      title: "Error",
      text: "Debes seleccionar una Ubicación",
      icon: "error",
    });
    return;
  }
  if (categoria === "") {
    swal.fire({
      title: "Error",
      text: "Debes seleccionar una Categoría",
      icon: "error",
    });
    return;
  }
  if (cantidad === "") {
    swal.fire({
      title: "Error",
      text: "El campo Cantidad es obligatorio",
      icon: "error",
    });
    return;
  }
  // Valida que la cantidad sea un número positivo
  if (isNaN(cantidad) || parseInt(cantidad) <= 0) {
    swal.fire({
      title: "Error",
      text: "La Cantidad debe ser un número positivo",
      icon: "error",
    });
    return;
  }

  if (anio === "") {
    swal.fire({
      title: "Error",
      text: "El campo Año de Publicación es obligatorio",
      icon: "error",
    });
    return;
  }
  if (isNaN(anio) || parseInt(anio) <= 0) {
    swal.fire({
      title: "Error",
      text: "El Año de Publicación debe ser un número positivo",
      icon: "error",
    });
    return;
  }
  var formData = new FormData($("#form_libros")[0]);
  $.ajax({
    url: "../../controllers/BookController.php?enpoint=save_and_update_books",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (data) {
      $("#tabla_libros").DataTable().ajax.reload();
      $("#modal_libro").modal("hide");
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
  /*TOOD:Actualizar Stock libros*/
  $.post(
    "../../controllers/PrestamoController.php?enpoint=update_stock_libros",
    { true: true },
    function (data) {
      console.log(data);
    }
  );
  /* TODO: Listar informacion en el datatable js */
  $("#tabla_libros").DataTable({
    aProcessing: true,
    aServerSide: true,
    dom: "Bfrtip",
    buttons: ["copyHtml5", "excelHtml5", "print"],
    ajax: {
      url: "../../controllers/BookController.php?enpoint=list_books",
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
    "../../controllers/BookController.php?enpoint=get_categories",
    { true: true },
    function (data) {
      $("#cate").html(data);
    }
  );
  $.post(
    "../../controllers/BookController.php?enpoint=get_authors",
    { true: true },
    function (data) {
      $("#autor").html(data);
    }
  );

  $.post(
    "../../controllers/BookController.php?enpoint=get_locations",
    { true: true },
    function (data) {
      $("#ubi").html(data);
    }
  );
});

function editar(Id) {
  $.post(
    "../../controllers/BookController.php?enpoint=list_book_id",
    { Id: Id },
    function (data) {
      console.log(data);
      data = JSON.parse(data); //Convertir a data a formato JSON
      $("#id").val(data.id);
      $("#codigo").val(data.codigo);
      $("#titulo").val(data.titulo);
      $("#autor").val(data.autor).trigger("change");
      $("#ubi").val(data.ubicacion).trigger("change");
      $("#cate").val(data.categoria).trigger("change");
      $("#cantidad").val(data.cantidad);
      $("#anio").val(data.publicacion);
    }
  );
  $("#lbltitulo").html("Actualizar Libro");

  $("#lblbtn").html("Actualizar");
  $("#modal_libro").modal("show");
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
          "../../controllers/BookController.php?enpoint=delete",
          { id: Id },
          function (data) {
            console.log(data); //Mostrar posibles errores en la consola
          }
        );
        //Recargar la tabla después de eliminar el registro
        $("#tabla_libros").DataTable().ajax.reload();
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
$(document).on("click", "#btn_nuevo_registro", function () {
  /* TODO: Limpiar informacion */
  $("#id").val("");
  $("#codigo").val("");
  $("#titulo").val("");
  $("#autor").val("");
  $("#ubi").val("");
  $("#cate").val("");
  $("#cantidad").val("");
  $("#anio").val("");
  $("#lbltitulo").html("Registrar Nuevo Libro");
  $("#lblbtn").html("Registrar");
  $("#form_libros")[0].reset();
  /* TODO: Mostrar Modal */
  $("#modal_libro").modal("show");
});

init();
