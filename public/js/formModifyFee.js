window.onload = function () {
   combo = document.getElementById("combo");
   var formModifyFee = document.getElementById("formModifyFee");

   formModifyFee.onsubmit = function (event) {
        if(!validarFormulario()) {
            console.log(cuotaValida);
            event.preventDefault();
        }
   }

   var cuota = document.getElementById("cuota");
   var errorCuota = document.getElementById("errorCuota");
   var cuotaValida = false;
   var regexNumeros = /^([0-9])*$/;

   cuota.onblur = function () {

     if(cuota.value < 1 || cuota.value.length < 3 || cuota.value.length > 15 || !regexNumeros.test(cuota.value)) {
     cuotaValida = false;
       errorCuota.style.display = "block";
        }  else {
        cuotaValida = true;
          errorCuota.style.display = "none";
        }

       if (cuota.value.length == 0) {
         cuotaValida = false;
         document.getElementById("spanCuota").innerHTML = "La cuota no puede quedar vacía.";
       }
      else if(regexNumeros.test(cuota.value) && cuota.value.length > 0 && cuota.value.length < 3 || cuota.value.length > 15) {
        cuotaValida = false;
       document.getElementById("spanCuota").innerHTML = "Inserte una cuota válida.";
     }
     else if(!regexNumeros.test(cuota.value)) {
       cuotaValida = false;
       document.getElementById("spanCuota").innerHTML = "Inserte solo valores numéricos.";
     }
     else if(cuota.value < 1) {
       cuotaValida = false;
       document.getElementById("spanCuota").innerHTML = "La cuota no puede ser de valor cero.";
     }
   }

     function validarFormulario () {

         if(cuotaValida == true) {
             return true;
       }
     }
   }
