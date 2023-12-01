var user_id = $("#variable_session_user_id_navbar").val();

/*
function init() {
  $("#form_mantenimiento").on("submit", function (e) {
    //hacemos referencia al formulario por ID
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
*/
$(document).ready(function () {
  $.post(
    "../../controllers/UserController.php?enpoint=list_user_id",
    { usuario_id: user_id },
    function (data) {
      //console.log(data);
      data = JSON.parse(data); //Convertir a data a formato JSON
      $("#nombre").text(data.nombre);
      $("#doc").text(data.numero_documento);
      $("#tel").text(data.telefono);
      $("#correo").text(data.correo);
      $("#nombre_rol").text(data.nombre_rol);
      $("#descripcion_rol").text(data.descripcion_rol);
      $("#dir").text(data.direccion);
      $("#fecha_registro").text(data.fecha_registro);
      $("#estado").text(data.estado);
      /*TODO:Form Index*/
      $("#user_profile").text(data.nombre);
      $("#rol_profile").text(data.nombre_rol);
      $("#nombres").val(data.nombre);
      $("#documento").val(data.numero_documento);
      $("#telefono").val(data.telefono);
      $("#direccion").val(data.direccion);
      /*TODO:NavBar*/
      $("#user").text(data.nombre);
      $("#user1").text(data.nombre);
      $("#rol").text(data.nombre_rol);
    }
  );
});

/*TODO:PROMESAS*/
$(document).on("click", "#btn_update", async function () {
  var nombres = $("#nombres").val();
  var documento = $("#documento").val();
  var telefono = $("#telefono").val();
  var direccion = $("#direccion").val();
  // Mostrar el SweetAlert para confirmar la actualización
  const result = await swal.fire({
    title: "Actualizar datos",
    text: "¿Está seguro que desea actualizar estos datos?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, Actualizar",
    cancelButtonText: "Cancelar",
  });

  // Verificar si el usuario hizo clic en "Aceptar"
  if (result.value) {
    try {
      // Realizar la solicitud POST para actualizar el perfil
      const data = await $.post(
        "../../controllers/UserController.php?enpoint=update_profile",
        {
          usuario_id: user_id,
          nombres: nombres,
          documento: documento,
          telefono: telefono,
          direccion: direccion,
        }
      );

      console.log(data); // Mostrar posibles errores en la consola

      // Mostrar un mensaje de éxito al usuario utilizando SweetAlert
      await swal.fire({
        title: "Datos actualizados",
        text: "Los datos del usuario han sido actualizados correctamente.",
        icon: "success",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Aceptar",
      });

      // Recargar la página después de que el usuario haya hecho clic en "Aceptar"
      location.reload();
    } catch (error) {
      // Mostrar mensaje de error si la solicitud POST falla
      console.error("Error al actualizar el perfil:", error);
      swal.fire({
        title: "Error",
        text: "Ocurrió un error al actualizar el perfil.",
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "Aceptar",
      });
    }
  }
});

/* TODO: CHANGES PASS */
$(document).on("click", "#btn_changes_password", function () {
  /* TODO: Limpiar información */
  $("#password-error, #new-password-error, #pass-confirm-error").text('');
  $("#contrasena, #new_password, #pass_confirm").removeClass("is-invalid");
   
  var pass = $("#contrasena").val();
  var new_pass = $("#new_password").val();
  var pass_confirm = $("#pass_confirm").val();
 
   
  if (!pass) {
    $("#password-error").text("Por favor, ingrese su contraseña actual.");
    $("#contrasena").addClass("is-invalid");
    return;
  }

  if (!new_pass) {
    $("#new-password-error").text("Por favor, complete el campo de nueva contraseña.");
    $("#new_password").addClass("is-invalid");
    return;
  }

  if (!pass_confirm) {
    $("#pass-confirm-error").text("Por favor, complete el campo de confirmación de contraseña.");
    $("#pass_confirm").addClass("is-invalid");
    return;
  }

   if (new_pass !== pass_confirm) {
    $("#pass-confirm-error").text("Las contraseñas no coinciden. Por favor, vuelva a ingresarlas.");
    $("#new_password, #pass_confirm").addClass("is-invalid");
    return;
  } else {
     var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    
    if (regex.test(new_pass)) {
      $.ajax({
        type: "POST",
        url: "../../controllers/UserController.php?enpoint=change_password",
        data: { user_id: user_id, password: pass, new_password: new_pass },
        success: function (data) {
          data = JSON.parse(data);
          Swal.fire({
            title: data.Mensaje.startsWith("Password") ? "Contraseña cambiada"  : "La contraseña no se pudo actualizar",
            text: data.Mensaje, icon: data.Mensaje.startsWith("Password") ? "success" : "error",
          });
        },
        error: function () {
          Swal.fire({
            title: "Error en la consulta",
            text: "Ocurrió un error en la solicitud",
            icon: "error",
          });
        },
      });
      $("#contrasena, #new_password, #pass_confirm").val("");
     } else {
      Swal.fire({
        title: "Error en la nueva contraseña",
        text: "La nueva contraseña debe contener caracteres especiales, mayúsculas, minúsculas y números. Además, debe tener al menos 8 caracteres.",
        icon: "error"
      });
     }
}



});

function editar(Id) {
  $.post(
    "../../controllers/UserController.php?enpoint=list_user_id",
    { usuario_id: Id },
    function (data) {
      console.log(data);
      data = JSON.parse(data); //Convertir a data a formato JSON
      $("#usuario_id").val(data.id);
      $("#nombre").val(data.nombre);
      $("#correo").val(data.correo);
      $("#pass").val(data.pass);
      $("#rol_id").val(data.rol_id).trigger("change");
      $("#estado").val(data.estado);
    }
  );
  $("#lblnombre").html("Actualizar Usuario");

  $("#lblbtn").html("Actualizar");
  $("#modal_mantenimiento").modal("show");
}

function eliminar(Id) {
  console.log(Id);
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
          "../../controllers/UserController.php?enpoint=delete",
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
