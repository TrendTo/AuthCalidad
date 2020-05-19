<html>
<head>
</head>
<body>
    <?php

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

    function conecFirebase($url){
        $query=curl_init();
        curl_setopt($query, CURLOPT_URL, $url);
        curl_setopt($query, CURLOPT_RETURNTRANSFER, true);
        $rs = curl_exec($query);
        curl_close($query);
        $data = json_decode($rs, true);
        return $data;
    }


    ?>
</body>
</html>