<html>
    <head>
        <meta charset="UTF-8">
        <title>  </title>
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script>
            $(function () {
                $("[id^=draggable]").draggable();
            });
        </script>
    </head>
    <body>
        <center>
        <h1 style="color:#8B0000;">Imagenes Seleccionadas</h1>  
            <div class="container"  >
                <?php
                foreach ($_POST['an'] as $fig) {
                    ?>
                    <div class="card" id="draggable_card" class="ui-widget-content">
                        <?php echo "<img src='" . $fig . "' height ='75' width='75'>"; ?>
                    </div>
                <?php } ?>   
            </div>
        </center>
        <script language="JavaScript">
            <!--
            function inhabilitar() {
                alert("Boton derecho deshabilitado para proteccion de codigo!");
                return false;
            }
            document.oncontextmenu = inhabilitar
            -->
        </script>
    </body>
</html>