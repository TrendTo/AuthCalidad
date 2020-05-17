<!DOCTYPE html>
<html>
    <head>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    </head>
    <body>
        <?php
        $vec=array();
        $data=array();
        $vec=$_POST['an'];
        array_push($data,'"user":"'.strval($vec[0]).'"');
        array_push($data,'"pass":"'.strval($vec[1]).'"');
        for ($i=2; $i < count($vec); $i++) { 
            # code...
            array_push($data,'"Patron '.strval($i-1).'":"'.strval($vec[$i]).'"');
        }

        $write='{'.implode(",",$data).'}';

        $url="https://calidad-project.firebaseio.com/users.json";
        $query=curl_init();
        curl_setopt($query, CURLOPT_URL, $url);
        curl_setopt($query, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($query, CURLOPT_POST, 1);
        curl_setopt($query, CURLOPT_POSTFIELDS, $write);
        //curl_setopt($query, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
        $rs = curl_exec($query);
        if (curl_errno($query)) {
            # code...
            echo "error: ".curl_errno($query);
            exit();
        }else{
        }
        curl_close($query);
        ?>
        <div class="row">
            <div class="app col-xl-6">
                <header>
                    <h2>VERIFICACION Y AUTENTICACIÓN</h2>
                </header>
                <div class="row items">
                    <?php
                    for ($i=2; $i < count($vec) ; $i++) { 
                    ?>
                    <div class="list-item row newItem" draggable="true">
                        <div class="card">
                        <?php
                        echo "<img src='$vec[$i]' height ='75' width='75'>";
                        ?>
                        </div>
                        <div class="card" id='valor'>
                        <?php
                        echo "<p></p>";
                        ?>
                        </div>    
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="lists" id="item">
                    <?php
                        for ($i=0; $i < 3; $i++) { 
                    ?>
                    <div class="list">
                        <p> Patron Posicion <?php echo $i+1;?></p>
                    </div>
                    <?php    
                        }
                    ?>
                </div>
            </div>
            <div class="col-xl-6 col-md-12" id="integracion">
                <?php    
                require_once("cryp.html");
                ?>
            </div>
        </div>
        <link rel="stylesheet" href="css/registro3.css">
        <script type="text/javascript" src="js/registro3.js"></script>
    </body>
    </html>