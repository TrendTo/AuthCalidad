<!DOCTYPE>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <?php
    $name = (isset($_POST['us'])) ? $_POST['us'] : "no name" ;
    $pass = (isset($_POST['ps'])) ? $_POST['ps'] : "no pass" ;
    if (($name && $pass) =="") {header("Location: registro.php");}

    $url="https://calidad-project.firebaseio.com/users.json";
    $query=curl_init();
    curl_setopt($query, CURLOPT_URL, $url);
    curl_setopt($query, CURLOPT_RETURNTRANSFER, true);
    $rs = curl_exec($query);
    curl_close($query);

    $user = json_decode($rs, true);
    $auth = array();
    foreach ($user as $key => $value) {
        # code...
        if ($value['user'] == $name) {
            # code...
            array_push($auth,$value['Patron 1']);
            array_push($auth,$value['Patron 2']);
            array_push($auth,$value['Patron 3']);
        break;
        }
    }
    print_r($auth);
    echo "<hr>";

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

    print_r($elem);

    $aux=$auth;
    echo "<hr>";
    $k1 = array_search($auth[0], $elem);
    $k2 = array_search($auth[1], $elem);
    $k3 = array_search($auth[2], $elem);
    unset($elem[$k1],$elem[$k2],$elem[$k3]);
    print_r($elem);
    echo "<hr>";

    shuffle($elem);
    print_r($elem);
    echo "<hr>";
    for ($i=0; $i < 17; $i++) { 
        # code...
        array_push($aux,strval($elem[$i]));
    }
    shuffle($aux);
    print_r($aux);

    ?>
    <div id="container">
        <div id="stage">
            <div class="d-flex justify-content-start py-3" id="titulo">
                <span class="card-title-blue" id="titulo">Verificacion y Autenticacion</span>
            </div>
            <div class="d-flex justify-content-center">
                <!-- <div class="scene">
                    <div class="card">
                        <div class="card__face card__face--front">
                            <p id="code">_</p>
                        </div>
                        <div class="card__face card__face--back">
                            <p id="code">_</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card__face card__face--front">
                            <p id="code">_</p>
                        </div>
                        <div class="card__face card__face--back">
                            <p id="code">_</p>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="d-inline-flex py-3 px-5" id="object">
                    <div id="ring1">
                        <div class="plane a selected">A</div>
                        <div class="plane b">B</div>
                        <div class="plane c">C</div>
                        <div class="plane d">D</div>
                        <div class="plane e">E</div>
                        <div class="plane f">F</div>
                        <div class="plane g">G</div>
                        <div class="plane h">H</div>
                        <div class="plane i">I</div>
                        <div class="plane j">J</div>
                        <div class="plane k">K</div>
                        <div class="plane l">L</div>
                        <div class="plane m">M</div>
                        <div class="plane n">N</div>
                        <div class="plane o">O</div>
                        <div class="plane p">P</div>
                        <div class="plane q">Q</div>
                        <div class="plane r">R</div>
                        <div class="plane s">S</div>
                        <div class="plane t">T</div>
                        <div class="plane u">U</div>
                        <div class="plane v">V</div>
                        <div class="plane w">W</div>
                        <div class="plane x">X</div>
                        <div class="plane y">Y</div>
                        <div class="plane z">Z</div>
                        <div class="plane zero">0</div>
                        <div class="plane one">1</div>
                        <div class="plane two">2</div>
                        <div class="plane three">3</div>
                        <div class="plane four">4</div>
                        <div class="plane five">5</div>
                        <div class="plane six">6</div>
                        <div class="plane seven">7</div>
                        <div class="plane eight">8</div>
                        <div class="plane nine">9</div>
                    </div>
                </div> -->
            </div>
            <div class="d-flex justify-content-around py-3">
                <a href="cryptex.php">AUTENTICATE</a>
            </div>
        </div>
    </div>

    <div class="scene2">
  <div class="carousel">
    <?php 
    foreach ($aux as $key => $value) {
    ?>
    <div class="carousel__cell">
        <div class="card">
            <div class="card__face card__face--front">
                <img src="<?php echo $value?>" alt="" height="100%" width="100%"/>
            </div>
            <div class="card__face card__face--back">
                <p id="code">_</p>
            </div>
        </div>
    </div>
    <?php 
    }
    ?>
  </div>
</div>

<div class="carousel-options">
  <p>
    <label>
      Cells
      <input class="cells-range" type="range" min="3" max="20" value="9" />
    </label>
  </p>
  <p>
    <button class="previous-button">Previous</button>
    <button class="next-button">Next</button>
  </p>
  <p>
    Orientation:
    <label>
      <input type="radio" name="orientation" value="horizontal" checked />
      horizontal
    </label>
    <label>
      <input type="radio" name="orientation" value="vertical" />
      vertical
    </label>
  </p>
</div>

    <link rel="stylesheet" href="css/authp1.css">
    <!-- <link rel="stylesheet" href="css/newcryptex.css"> -->
    <!-- <script type="text/javascript" src="js/cryptex.js"></script> -->
    <script type="text/javascript" src="js/authp1.js"></script>
</body>

</html>