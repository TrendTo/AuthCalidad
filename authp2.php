<!DOCTYPE>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <?php
    require_once("valid.php");

    $name = (isset($_POST['us'])) ? $_POST['us'] : "" ;
    $pass = (isset($_POST['ps'])) ? $_POST['ps'] : "" ;
    if (($name && $pass) =="") {header("Location: authp1.html");}

    $newtest = consultaUsuario($name,$pass);
    if (!$newtest) header("Location: authp1.html");

    $auth = consultaPatron($name,$pass);
    //print_r($auth);
    //echo "<hr>";

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


    $elem = array();
    foreach ($data as $key => $value) {
        $url="https://calidad-project.firebaseio.com/imagenes/categoria/$key.json";
        $query=curl_init();
        curl_setopt($query, CURLOPT_URL, $url);
        curl_setopt($query, CURLOPT_RETURNTRANSFER, true);
        $rs = curl_exec($query);
        curl_close($query);
        for ($i=0; $i < count($value); $i++) { 
            # code...
            array_push($elem,$value[$i]);
        }
    }

    //print_r($elem);

    $aux=$auth;
    //echo "<hr>";
    $k1 = array_search($auth[0], $elem);
    $k2 = array_search($auth[1], $elem);
    $k3 = array_search($auth[2], $elem);
    unset($elem[$k1],$elem[$k2],$elem[$k3]);
    //print_r($elem);
    //echo "<hr>";

    shuffle($elem);
    //print_r($elem);
    //echo "<hr>";
    for ($i=0; $i < 17; $i++) { 
        # code...
        array_push($aux,strval($elem[$i]));
    }
    shuffle($aux);
    //print_r($aux);

    ?>
    <div id="container">
        <div id="stage">
            <div class="d-flex justify-content-start py-3" id="titulo">
                <span>Verificacion y Autenticacion</span>
            </div>
            <div class="d-flex justify-content-around">
                <div class="row replica">
                    <?php 
                    for ($i=0; $i < 3; $i++) { 
                    ?>
                    <div class="scene2">
                        <div class="carousel" id="testCard">
                            <?php
                            shuffle($aux); 
                            foreach ($aux as $key => $value) {
                            ?>
                            <div class="carousel__cell">
                                <div class="card">
                                    <img src="<?php echo $value?>" alt="" height="100%" width="100%"/>
                                </div>
                            </div>
                            <?php 
                            }
                            ?>
                        </div>
                    </div>
                    <?php 
                    }
                    ?>
                </div>
            </div>
            <div>
                <div class="carousel-options">
                    <input class="cells-range" type="hidden" value="20" />
                    <p>
                        Orientation:
                        <label>
                        <input type="radio" name="orientation" value="horizontal"/>
                        horizontal
                        </label>
                        <label>
                        <input type="radio" name="orientation" value="vertical" checked />
                        vertical
                        </label>
                    </p>
                </div>
            </div>
            <div class="d-flex justify-content-around py-3">
                <form name="valores" action="authp3.php" method="POST">
                    <input type="hidden" name="patron1" value="" />
                    <input type="hidden" name="patron2" value="" />
                    <input type="hidden" name="patron3" value="" />
                    <input type="submit" value="AUTENTICATE" onclick="parametros();"/>
                </form>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="css/authp1.css">
    <script type="text/javascript" src="js/authp1.js"></script>
</body>

</html>