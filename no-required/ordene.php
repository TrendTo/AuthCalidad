<!DOCTYPE HTML>
<html>
    <head>
        <link href="css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.js"></script>
        <link rel="stylesheet" href="css/estilos.css">
        <script type="text/javascript">
            $(document).ready(function () {
                $('#imagenes').sortable({
                    revert: true,
                    opacity: 0.6,
                    cursor: 'move',
                    update: function () {
                        var order = $('#imagenes').sortable("serialize") + '&action=orderState';
                        $.post("ajax.php", order, function (theResponse) {
                            $('#success').html('Gracias por ordenar las ciudades!').slideDown('fast').delay(1000).slideUp('fast');
                        });
                    }
                });
            });
        </script>
    </head>
    <body>
        <p>Ordene sus cartas segun patron escogido</p>

    <center>
        <h1 style="color:#8B0000;">Imagenes Seleccionadas</h1>  
        <div class="container" id="imagenes" class="sortable" >

            <?php
            foreach ($_POST['an'] as $fig) {
                ?>

                <div class="card" >
                    <?php echo "<" . "img" . " " . "src" . "=" . "'" . "figuras" . "/" . $fig . "." . "png" . "'" . " " . "height" . "=" . "'150'" . " " . "width" . "=" . "'150'" . ">"; ?>
                </div>
            <?php } ?>   
        </div>
    </center>

    <script language="JavaScript">
<!--
        function inhabilitar() {
            alert("Boton derecho deshabilitado para proteccion de codigo!")
            return false
        }
        document.oncontextmenu = inhabilitar
// -->
    </script>
</body>
</html>