<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    <body>
    
    <?php
    ///////////////////////////////////////////////// TRATANDO DE VALIDAR 
    $name = (isset($_POST['us'])) ? $_POST['us'] : "no name" ;
    $pass = (isset($_POST['ps'])) ? $_POST['ps'] : "no pass" ;
    $cate = (isset($_POST['opciones'])) ? $_POST['opciones'] : "" ;
    

    if (($name && $pass && $cate) =="") {header("Location: registro.php");}

    $url="https://calidad-project.firebaseio.com/imagenes/categoria/$cate.json";
    $query=curl_init();
    curl_setopt($query, CURLOPT_URL, $url);
    curl_setopt($query, CURLOPT_RETURNTRANSFER, true);
    $rs = curl_exec($query);
    curl_close($query);

    $data = json_decode($rs, true);
    $elem = array();
    for ($i=0; $i < count($data); $i++) { 
        # code...
        array_push($elem,strval($data[$i]));
    }
      /////////////////////////////////////////////////////////////
    ?> 
        <center>
        <h1 style="color:#8B0000;">Seleccion de imagenes</h1>
        <form name="ingreso" action="registro3.php" method="POST">
        <div class="fila">
            <div class="container">
            <input type="hidden" name="an[]" value="<?php echo $name ?>">
            <input type="hidden" name="an[]" value="<?php echo $pass ?>">
        <?php
            $aux=1;
            for ($j=0; $j < count($elem); $j++) { 
            ?>
                <div class="card">
                    <label>
                        <input type="checkbox" name="an[]" value="<?php echo $elem[$j] ?>" class="micheck">
                        <img src="<?php echo $elem[$j] ?>" alt="" height="75" width="75"/>
                    </label>
                </div>
                <?php                
                if ($aux < 5) {
                    $aux++;
                }else{
                    ?>
            </div>
        </div>
            <?php
            if ($j<=count($elem)) {
            ?>
            <div class="fila">
                <div class="container">
            <?php
            }
                $aux=1;
            }
            if($j==(count($elem)-1)){
            ?>
                </div>
            </div>
            <?php
            }
        }
        ?>
            <div class="fila next">
                <input type="submit" value="Enviar datos">
            </div>
            </form>
        </center>
        <script language="JavaScript">
            <!--
            function inhabilitar() {
                alert("Boton derecho deshabilitado para proteccion de codigo!");
                return false;
            }
            var elementos=document.getElementsByClassName("micheck");
            for(var i=0;i<elementos.length;i++) {
                elementos[i].addEventListener("click", contarSeleccionados, false);
            };
            
            // Esta función se ejecuta cada vez que se pulsa sobre un checkbox
            function contarSeleccionados(event) {
                count=0;
                var elementos=document.getElementsByClassName("micheck");
                for(var i=0;i<elementos.length;i++) {
                    if(elementos[i].checked)
                        count++;
                };
            
                // Si hay mas de 5 checkbox seleccionados, cancelamos el click
                if(count>3)
                {
                    event.preventDefault();
                }
            }
            document.oncontextmenu = inhabilitar
            -->
        </script>
    </body>
</html>