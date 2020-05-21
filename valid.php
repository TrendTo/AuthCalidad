<html>
<head>
</head>
<body>
    <?php
    
    $info = (isset($_POST['data'])) ? $_POST['data'] : "" ;
    $v1 = (isset($_POST['valor1'])) ? $_POST['valor1'] : "" ;
    $v2 = (isset($_POST['valor2'])) ? $_POST['valor2'] : "" ;
    $v3 = (isset($_POST['valor3'])) ? $_POST['valor3'] : "" ;
    $ua = (isset($_POST['use'])) ? $_POST['use'] : "" ;
    $pa = (isset($_POST['pas'])) ? $_POST['pas'] : "" ;
    $ea = (isset($_POST['est'])) ? $_POST['est'] : "" ;
    $card = (isset($_POST['carta'])) ? $_POST['carta'] : "" ;
    $text = (isset($_POST['val'])) ? $_POST['val'] : "" ;
    
    if($info&&$v1&&$v2&&$v3){
        $datanew=array();
        $datanew=$info;
        array_push($datanew,strval($v1));
        array_push($datanew,strval($v2));
        array_push($datanew,strval($v3));
        creacionUser($datanew);
    }
    if ($ua&&$pa&&$card) {
        compareValue($card,$ua,$pa,$text);
    }

    function consultaUsuario($name, $pass){
        $url="https://calidad-project.firebaseio.com/users.json";
        $data = conecFirebase($url);
        $test = array();
        foreach ($data as $key => $value) {
            $test[$key] = $value;
        }
        $keyus = array_search($name, array_column($test, 'user'));
        $keyps = array_search($pass, array_column($test, 'pass'));
        
        if ($keyus == $keyps) {
            return true;
        }else {
            return false;
        }
    }

    function consultaPatron($name, $pass){
        $url="https://calidad-project.firebaseio.com/users.json";
        $data = conecFirebase($url);
        $auth = array();
        foreach ($data as $key => $value) {
            # code...
            if ($value['user'] == $name && $value['pass'] == $pass) {
                # code...
                array_push($auth,$value['Patron 1']);
                array_push($auth,$value['Patron 2']);
                array_push($auth,$value['Patron 3']);
            break;
            }
        }
        return $auth;
    }

    function consultaValores($name, $pass){
        $url="https://calidad-project.firebaseio.com/users.json";
        $data = conecFirebase($url);
        $auth = array();
        foreach ($data as $key => $value) {
            # code...
            if ($value['user'] == $name && $value['pass'] == $pass) {
                # code...
                array_push($auth,$value['Valor 1']);
                array_push($auth,$value['Valor 2']);
                array_push($auth,$value['Valor 3']);
            break;
            }
        }
        return $auth;
    }

    function creacionUser($vec){
        $data=array();
        array_push($data,'"user":"'.strval($vec[0]).'"');
        array_push($data,'"pass":"'.strval($vec[1]).'"');
        for ($i=2; $i < 5; $i++) { 
            array_push($data,'"Patron '.strval($i-1).'":"'.strval($vec[$i]).'"');
        }
        for ($i=5; $i < count($vec); $i++) { 
            array_push($data,'"Valor '.strval($i-4).'":"'.strval($vec[$i]).'"');
        }
        $write='{'.implode(",",$data).'}';

        $url="https://calidad-project.firebaseio.com/users.json";
        $query=curl_init();
        curl_setopt($query, CURLOPT_URL, $url);
        curl_setopt($query, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($query, CURLOPT_POST, 1);
        curl_setopt($query, CURLOPT_POSTFIELDS, $write);
        $rs = curl_exec($query);
        if (curl_errno($query)) {
            echo "error: ".curl_errno($query);
            exit();
        }
        curl_close($query);
        header("Location: registro.php");
    }

    function conecFirebase($url){
        $query=curl_init();
        curl_setopt($query, CURLOPT_URL, $url);
        curl_setopt($query, CURLOPT_RETURNTRANSFER, true);
        $rs = curl_exec($query);
        curl_close($query);
        $data = json_decode($rs, true);
        return $data;
    }

    function compareCard($a1,$a2){
        $numero=0;
        for ($n=0; $n < count($a1); $n++) { 
            if ($a1[$n]==$a2[$n]) {
                $numero++;
                if ($numero==count($a1)) {
                    return true;
                }
            }else{
                return false;
            }
        }
    }

    function compareValue($dato,$ua,$pa,$tex){
        $t=0;
        $e1=consultaPatron($ua,$pa);
        $e2=consultaValores($ua,$pa);
        print_r($e1);
        print_r($e2);
        echo $dato;
        for ($i=0; $i < count($e1); $i++) { 
            if ($e1[$i]==$dato) {
                $t=$i;
            }
        }
        echo "El valor de i es: ".$t;
        echo "El valor ingresado es: ".$tex;
        echo "y el valor a comparar es:".$e2[$t];
        if ($e2[$t]==$tex) {
            echo "codigo correcto";
        }else{
            echo "ya valio madres";
        }
    }
    ?>
</body>
</html>