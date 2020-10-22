  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap core JavaScript -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Notificaciones -->
  <link href="lib/notyf/notyf.min.css" rel="stylesheet">
  <script src="lib/notyf/notyf.min.js"></script>
  <script>
    function toast_s($mensaje) {
        var notyf = new Notyf();
        notyf.success($mensaje);
    }
      
    function toast_e($mensaje) {
        var notyf = new Notyf();
        notyf.error($mensaje);
    }
  </script>