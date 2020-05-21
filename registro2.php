<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    <body>
    
    <?php
    require_once("valid.php");
    ///////////////////////////////////////////////// TRATANDO DE VALIDAR 
    $name = (isset($_POST['us'])) ? $_POST['us'] : "no name" ;
    $pass = (isset($_POST['ps'])) ? $_POST['ps'] : "no pass" ;
    $cate = (isset($_POST['opciones'])) ? $_POST['opciones'] : "" ;
    

    if (($name && $pass && $cate) =="") {header("Location: registro.php");}

    $url="https://calidad-project.firebaseio.com/imagenes/categoria/$cate.json";
    $data = conecFirebase($url);
    $elem = array();

    for ($i=0; $i < count($data); $i++) { 
        array_push($elem,strval($data[$i]));
    }
      /////////////////////////////////////////////////////////////
    ?> 
        <div>
            <h1>Seleccion de imagenes</h1>
            <h2>Nota Importante:</h2>
            <ul>
                <li>Para continuar con el proceso seleccione <strong>3 imagenes</strong></li>
            </ul>
        </div>
        <center>
        <form name="ingreso" action="registro3.php" method="POST" >
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
                <input type="submit" value="Enviar datos" onclick="mensaje()">
            </div>
            </form>
        </center>
        <script language="JavaScript">
            <!--
            var val=0;
            function inhabilitar() {
                alert("Boton derecho deshabilitado para proteccion de codigo!");
                return false;
            }
            var elementos=document.getElementsByClassName("micheck");
            for(var i=0;i<elementos.length;i++) {
                elementos[i].addEventListener("click", contarSeleccionados, false);
            };
            
            function mensaje(){
                if(val<3){
                    alert("Debe Seleccionar 3 elementos");
                    event.preventDefault();
                }
            };
            // Esta función se ejecuta cada vez que se pulsa sobre un checkbox
            function contarSeleccionados(event) {
                count=0;
                var elementos=document.getElementsByClassName("micheck");
                for(var i=0;i<elementos.length;i++) {
                    if(elementos[i].checked)
                        count++;
                        val=count;
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