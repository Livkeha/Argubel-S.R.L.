window.onload = function () {
   combo = document.getElementById("combo");
   var formModifyFee = document.getElementById("newFee");

   formModifyFee.onsubmit = function (event) {
        if(!validarFormulario()) {
            console.log(cuotaValida);
            event.preventDefault();
        }
   }
