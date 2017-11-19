window.onload = function () {
   combo = document.getElementById("combo");
   var formNewUser = document.getElementById("formNewUser");

   formNewUser.onsubmit = function (event) {
        if(!validarFormulario()) {
            console.log(nombreValido, apellidoValido, documentoValido, telefonoValido, correoValido, passwordValido, cPasswordValido);
            event.preventDefault();
        }
   }

       var nombre = document.getElementById("nombre");
       var errorNombre = document.getElementById("errorNombre");
       var nombreValido = false;

       nombre.onblur = function () {
       if (nombre.value.length == 0) {
         nombreValido = false;
         errorNombre.style.display = "block";
         document.getElementById("spanNombre").innerHTML = "El nombre no puede quedar vacío.";
        }
        else {
          nombreValido = true;
          errorNombre.style.display = "none";
        }
       }

       var apellido = document.getElementById("apellido");
       var errorApellido = document.getElementById("errorApellido");
       var apellidoValido = false;

       apellido.onblur = function () {
       if (apellido.value.length == 0) {
         apellidoValido = false;
         errorApellido.style.display = "block";
         document.getElementById("spanApellido").innerHTML = "El apellido no puede quedar vacío.";
       } else {
         apellidoValido = true;
         errorApellido.style.display = "none";
          }
       }

       var documento = document.getElementById("documento");
       var errorDocumento = document.getElementById("errorDocumento");
       var regexNumeros = /^([0-9])*$/;
       var documentoValido = false;

       documento.onblur = function () {


         // debugger;
         if (documento.value.length >= 0 && documento.value.length < 7 || documento.value.length > 8 || !regexNumeros.test(documento.value)) {
         documentoValido = false;
           errorDocumento.style.display = "block";
         } else {
         documentoValido = true;
           errorDocumento.style.display = "none";
         }

         if (documento.value.length == 0) {
           documentoValido = false;
           document.getElementById("spanDocumento").innerHTML = "El documento no puede quedar vacío.";
         }
        else if(regexNumeros.test(documento.value) && documento.value.length >= 0 && documento.value.length < 7 || documento.value.length > 8) {
          documentoValido = false;
         document.getElementById("spanDocumento").innerHTML = "Inserte un documento válido.";
       }
       else if(!regexNumeros.test(documento.value)) {
         documentoValido = false;
         document.getElementById("spanDocumento").innerHTML = "Inserte solo valores numéricos.";
       }

       }

         var telefono = document.getElementById("telefono");
         var errorTelefono = document.getElementById("errorTelefono");
         var telefonoValido = false;

         telefono.onblur = function () {

           if(telefono.value.length < 6 || telefono.value.length > 20 || !regexNumeros.test(telefono.value)) {
           telefonoValido = false;
             errorTelefono.style.display = "block";
              }  else {
              telefonoValido = true;
                errorTelefono.style.display = "none";
              }

             if (telefono.value.length == 0) {
               telefonoValido = false;
               document.getElementById("spanTelefono").innerHTML = "El teléfono no puede quedar vacío.";
             }
            else if(regexNumeros.test(telefono.value) && telefono.value.length > 0 && telefono.value.length < 5 || telefono.value.length > 20) {
              telefonoValido = false;
             document.getElementById("spanTelefono").innerHTML = "Inserte un teléfono válido.";
           }
           else if(!regexNumeros.test(telefono.value)) {
             telefonoValido = false;
             document.getElementById("spanTelefono").innerHTML = "Inserte solo valores numéricos.";
           }
         }


         var correo = document.getElementById("correo");
         var regexMail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
         var correoValido = false;

         correo.onblur = function () {

           if(correo.value.length == 0 && !regexMail.test(correo.value)) {
             correoValido = false;
             errorCorreo.style.display = "block";
             document.getElementById("spanCorreo").innerHTML = "El correo electrónico no puede quedar vacío.";

         } else if (correo.value.length != 0 && regexMail.test(correo.value)) {
              correoValido = true;
              errorCorreo.style.display = "none";
         }

         if (correo.value.length != 0 && !regexMail.test(correo.value)) {
           correoValido = false;
           errorCorreo.style.display = "block";
           document.getElementById("spanCorreo").innerHTML = "Inserte un correo electrónico válido.";
         }
       }

      var password = document.getElementById("password");
      var errorPassword = document.getElementById("errorPassword");
      var passwordValido = false;

      password.onblur = function () {

        if (password.value.length == 0 || password.value.length < 6 && password.value != cpassword.value) {
          passwordValido = false;
          cPasswordValido = true;
          errorPassword.style.display = "block";
        } else if (password.value.length >= 6 && password.value == cpassword.value) {
          passwordValido = true;
          cPasswordValido = true;
          errorPassword.style.display = "none";
          errorCPassword.style.display = "none";
        }

        if (password.value.length == 0) {
          passwordValido = false;
          cPasswordValido = false;
          document.getElementById("spanPassword").innerHTML = "La contraseña no puede quedar vacía.";
        } else if (password.value.length < 6) {
          passwordValido = false;
          cPasswordValido = false;
          document.getElementById("spanPassword").innerHTML = "La contraseña debe tener un mínimo de 6 caracteres.";
        } else if (password.value != cpassword.value) {
          passwordValido = false;
          cPasswordValido = false;
          document.getElementById("spanPassword").innerHTML = "Las contraseñas no coinciden.";
        }
      }

      var cpassword = document.getElementById("cpassword");
      var errorCPassword = document.getElementById("errorCPassword");
      var cPasswordValido = false;

      cpassword.onblur = function () {

        if (cpassword.value.length == 0 || cpassword.value.length < 6 && password.value != cpassword.value) {
          passwordValido = false;
          cPasswordValido = false;
          errorCPassword.style.display = "block";
        } else if (cpassword.value.length >= 6 && password.value == cpassword.value) {
          passwordValido = true;
          cPasswordValido = true;
          errorPassword.style.display = "none";
          errorCPassword.style.display = "none";
        }

        if (cpassword.value.length == 0) {
          passwordValido = false;
          cPasswordValido = false;
        document.getElementById("spanCPassword").innerHTML = "La verificación de la contraseña no puede quedar vacía.";
      } else if (cpassword.value.length < 6) {
        passwordValido = false;
        cPasswordValido = false;
        document.getElementById("spanCPassword").innerHTML = "La verificación debe tener un mínimo de 6 caracteres.";
      } else if (password.value != cpassword.value) {
        passwordValido = false;
        cPasswordValido = false;
        document.getElementById("spanCPassword").innerHTML = "Las contraseñas no coinciden.";
      }
    }

     function validarFormulario () {

         if(nombreValido == true && apellidoValido == true && documentoValido == true && telefonoValido == true && correoValido == true && cPasswordValido == true) {
             return true;
       }
     }
   }
