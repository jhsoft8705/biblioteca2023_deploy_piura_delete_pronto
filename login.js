 
 document.addEventListener("DOMContentLoaded", function() {
    var passErrorElement = document.getElementById('pass-error');
    var userErrorElement = document.getElementById('user-error');

    if (passErrorElement !== null) {
        passErrorElement.innerHTML = '¡Por favor, introduzca su contraseña!';
    }

    if (userErrorElement !== null) {
        userErrorElement.innerHTML = 'Por favor, ingrese su nombre de usuario';
    }
});
 