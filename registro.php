<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title></title> 
	<meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=3.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
	<link rel="stylesheet" href="css/estiloslr.css">
</head>
<body>

    <?php
    require_once("valid.php");

    $url ="https://calidad-project.firebaseio.com/imagenes/categoria.json";
    $data = conecFirebase($url);
    ?>

    <form class="formulario" action="registro2.php" method="POST">
        <h1>Registrate</h1>
        <div class="contenedor">
            <div class="input-contenedor">
                <i class="fas fa-user icon"></i>
                <input type="text" placeholder="Usuario" name="us" required>
            </div>
            <div class="input-contenedor">
                <i class="fas fa-key icon"></i>
                <input type="password" placeholder="Contraseña" minlength="6" maxlength="12" name="ps" required>
            </div>
            <div class="input-contenedor">
                <select name="opciones">
                    <option value="" selected="selected">Categoria</option>
                    <?php
                    foreach ($data as $opc => $value) {
                        ?>
                        <option value="<?php echo $opc ?>"><?php echo $opc ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <input type="submit" value="Registrate" class="button">
            <p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
            <p>¿Ya tienes una cuenta? <a class="link" href="authp1.html">Iniciar Sesion</a></p>
        </div>
    </form>
</body>
</html>