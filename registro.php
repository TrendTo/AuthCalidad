<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php
        $url="https://calidad-project.firebaseio.com/imagenes/categoria.json";
        $query=curl_init();
        curl_setopt($query, CURLOPT_URL, $url);
        curl_setopt($query, CURLOPT_RETURNTRANSFER, true);
        $rs = curl_exec($query);
        if (curl_errno($query)) {
            # code...
            echo "error: ".curl_errno($query);
            exit();
        }else{
            $data = json_decode($rs, true);
        }
        curl_close($query);
        ?>
        <meta charset="UTF-8">
        <title></title>
        <!--        <link rel="stylesheet" href="css/registro.css">-->
        <link rel='stylesheet' href='https://fiprofile.cdnpk.net/dist/css/profile.css?key=87e29b598a990f7feb0e8c72654ce4c62020050121'>
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/headfooter.css">

    </head>
    <body background="./imagenes/fondo.jpg">
        <div>
            <?php
            include 'header.php';
            ?>
        </div>
        <div class="container">
            <form action="index.php" method="POST">
            <section id="gr_registerbox" class="gr_box register" style="display: block;">
                <div class="box__holder" >
                    <div class="box">
                        <center><h1 class="text__gray--9">REGISTRARSE</h1></center> 
                        <span class="input-group">
                            <input type="text" name="register-username" id="register-username" tabindex="1" autocomplete="off" autofocus="" autocapitalize="off" autocorrect="off">
                            <label for="register-username">Username</label>
                            <a href="javascript:void(0);" class="reset-input">×</a>
                        </span>
    
                        <span class="input-group">
                            <input type="email" name="register-email" id="register-email" tabindex="4" autocomplete="off" autocapitalize="off" autocorrect="off">
                            <label for="register-email">Email</label>
                            <a href="javascript:void(0);" class="reset-input">×</a>
                        </span>
    
                        <span class="input-group password-register-group">
                            <input type="password" name="register-password" id="register-password" tabindex="5" autocomplete="off" autocapitalize="off" autocorrect="off">
                            <label for="register-password">Password</label>
    
                            <span class="show-password">
                                <input type="checkbox" name="register-show-password" id="register-show-password" value="">
                                <label for="register-show-password" class="state--inactive" title="Show password">
                                    <i class="flaticon-eye"></i>
                                </label>
                                <label for="register-show-password" class="state--active" title="Hide password">
                                    <i class="flaticon-eye-line-through"></i>
                                </label>
                            </span>
    
                            <div class="row">
                                <span class="col__xs--12 password-result-container text-center">
                                    <span class="short">Mínimo 6 caracteres</span>
                                    <span class="weak">Débil</span>
                                    <span class="good">Bueno</span>
                                    <span class="strong">Fuerte</span>
                                </span>
                                <div class="col__xs--12 text-center">
                                    <span class="alignl font-sm">Su contraseña debe tenr mínimo 6 caracteres. No debe contener espacios en blanco.</span>
                                </div>
                            </div>
                        </span>
    
                        <div class="mBottom"></div>
                        <center><h3 class="text__gray--9"> Para autenticarse elija una categoría</h1></center> 
    
                        <select name=opciones id="personal" class="select-css col-12">
                            <option value="" selected="selected">Seleccionar categría</option>
                            <?php
                            foreach ($data as $opc => $value) {
                                # code...
                                ?>
                                <option value="<?php echo $opc?>"><?php echo $opc ?></option>
                                <?php
                            }
                            ?>
                        </select>
    
                        <button type="submit" class="btn fullwidth spinner_button" id="signup_button" tabindex="7">REGISTRARSE</button>
    
                        <div class="bottom-links">
                            <a href="javascript:void(0);" class="href-sign-in" onclick="gr.auth.login_form();">Ya está registrado? Inicie sesión</a>
                        </div><!-- .bottom-links -->
                    </div><!-- .box -->
                </div><!-- .box__holder -->
                <br><br><br>
            </section>
            </form>
        </div>
        <div>
            <?php
            include 'footer.php';
            ?>
        </div>
    </body>
</html>
