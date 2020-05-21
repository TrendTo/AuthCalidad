<!DOCTYPE>
<html>
<body>
    <?php
    require_once('valid.php');

    $a=(isset($_POST['patron1'])) ? $_POST['patron1'] : "" ;
    $b=(isset($_POST['patron2'])) ? $_POST['patron2'] : "" ;
    $c=(isset($_POST['patron3'])) ? $_POST['patron3'] : "" ;
    $u=(isset($_POST['uss'])) ? $_POST['uss'] : "" ;
    $p=(isset($_POST['pss'])) ? $_POST['pss'] : "" ;
    
    $datos=array();
    $auth=consultaPatron($u, $p);
    array_push($datos,$a,$b,$c);
    $estado=0;
    if (compareCard($auth,$datos)) {
        $estado=1;
    }else{
        $estado=0;
    }

    shuffle($datos);
    ?>
    <div id="container">
        <div id="stage">
            <div style="margin: 20px 200px;" id="titulo">
                <h1 style="margin: 20px 0px">Autenticacion</h1>
                <h2>Nota importante</h2>
                <ul>
                    <li>Ingrese el valor asignado a la imagen que se muestra</li>
                </ul>
            </div>
            <div class="card" id="cardImagen">
                <img src="<?php echo $datos[0]; ?>"/>
            </div>
            <?php    
            require_once("cryp.html");
            ?>
            <div class="d-flex justify-content-around py-3">
                <form name="ultimo" action="valid.php" method="POST">
                    <input type="hidden" name="use" value="<?php echo $u; ?>">
                    <input type="hidden" name="pas" value="<?php echo $p; ?>">
                    <input type="hidden" name="est" value="<?php echo $estado; ?>">
                    <input type="hidden" name="carta" value="<?php echo $datos[0]; ?>">
                    <input type="hidden" name="val" value="">
                    <input type="submit" value="Autenticate" onclick="pushLink()" style="font-family:none">
                </form>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="css/authp3.css">
    <script type="text/javascript" src="js/authp3.js"></script>
</body>
</html>