(function ($) {
  "use strict";
  var notify = $.notify('<i class="fa-regular fa-bell"></i><strong>Cargando</strong>Paciencia por favor...', {
    type: "theme",
    allow_dismiss: true,
    delay: 2000,
    showProgressbar: true,
    timer: 300,
    animate: {
      enter: "animated fadeInDown",
      exit: "animated fadeOutUp",
    },
  });

})(jQuery);
