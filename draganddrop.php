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
        <div class="row mx-5">
            <div class="my-3 col-xl-6 col-md-12">
                <div id="listOfExpectation" class="d-flex justify-content-start py-3 mx-5">
                    <span class="card-title-blue">Iconos Seleccionados:</span>
                </div>
                <div class="row d-flex justify-content-around mx-5 my-3">
                    <?php
                    for ($i=2; $i < count($vec) ; $i++) { 
                    ?>
                    <div class="row d-flex justify-content-center my-2">
                        <div class="card yes-drop drag-drop" data-draggable="item">
                        <?php
                        echo "<img src='$vec[$i]' height ='75' width='75'>";
                        ?>
                        </div>    
                    </div>
                    <?php
                    }
                    ?>
                </div>   
                    <!-- Rating-->
                <div class="row d-flex justify-content-center mt-2">
                    <?php
                    for ($i=0; $i < 3; $i++) { 
                        # code...
                    ?>
                    <div class="col20p text-center mx-md-3">
                        <div class="droppable-section-header droppable-section-midblue py-3 px-2" id="pu<?php echo $i;?>">
                            <p class="mb-0 mt-2"> Patron Posicion <?php echo $i+1;?></p>
                        </div>
                        <div class="px-2 pt-3 border dropzone " id="item<?php echo $i;?>" style="min-height:150px;">
                        </div>
                    </div>
                    <?php    
                    }
                    ?>
                </div>
            </div>
            <div class="my-3 col-xl-6 col-md-12">
                <?php    
                require_once("cryptex.php");
                ?>
            </div>
            <div class="d-flex justify-content-around py-3 col-12">
                <a href="cryptex.php">AUTENTICATE</a>
            </div>

        </div>
        <link rel="stylesheet" href="css/dad.css">
        <script type="text/javascript" src="js/dad.js"></script>
    </body>
    </html>