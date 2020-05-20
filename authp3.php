<!DOCTYPE>
<html>
<body>
    <?php
    $a=(isset($_POST['patron1'])) ? $_POST['patron1'] : "" ;
    $b=(isset($_POST['patron2'])) ? $_POST['patron2'] : "" ;
    $c=(isset($_POST['patron3'])) ? $_POST['patron3'] : "" ;
    $datos=array();

    array_push($datos,$a,$b,$c);
    shuffle($datos);
    ?>
    <div id="container">
        <div id="stage">
            <div class="d-flex justify-content-start py-3" id="titulo">
                <span class="card-title-blue" id="titulo">Verificacion y Autenticacion</span>
            </div>
            <div class="card" id="cardImagen">
                <img src="<?php echo $datos[0]; ?>"/>
            </div>
            <?php    
            require_once("cryp.html");
            ?>
            <div class="d-flex justify-content-around py-3">
                <a href="cryptex.php">AUTENTICATE</a>
            </div>
        </div>
    </div>
</body>
</html>