// Deshabilita el envío de formularios si hay campos no válidos.
(function () {
  "use strict";

  // Obtiene todos los formularios a los que se quiere aplicar estidlo de validación personalizada con Bootstrap.
  var forms = document.querySelectorAll(".needs-validation");

  // Realiza un bucle sobre los distintos formularios y previene su envío por defecto.
  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
})();
