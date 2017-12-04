window.onload = function () {
   combo = document.getElementById("combo");
   var formModifyPass = document.getElementById("formModifyPass");

   formModifyPass.onsubmit = function (event) {
        if(!validarFormulario()) {
            console.log(passwordValido, cPasswordValido);
            event.preventDefault();
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

         if(cPasswordValido == true) {
             return true;
       }
     }
   }
