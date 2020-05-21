<!DOCTYPE html>
<html>
    <head>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
    </head>
    <body>
        <?php
        require_once("valid.php");

        $vec=array();
        $vec=$_POST['an'];
        ?>
        <div class="work">
            <div class="col-12">
                <header>
                    <h2>VERIFICACION Y AUTENTICACIÓN</h2>
                </header>
            </div>
            <div class="row">
                <div class="app col-xl-6">
                    <div class="row items" id="arriba">
                        <?php
                        for ($i=2; $i < count($vec) ; $i++) { 
                        ?>
                        <div class="list-item row newItem" draggable="true" id="selec">
                            <div class="card col-12">
                            <?php
                            echo "<img src='$vec[$i]' height ='75' width='75'>";
                            ?>
                            </div>
                            <div class="card col-12" id='valor'>
                            <?php
                            echo "<p id='texto'></p>";
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
                <div>
                    <form name="valor" action="valid.php" method="POST">
                        <?php
                        for ($i=0; $i < count($vec); $i++) { 
                        ?>
                        <input type="hidden" name="data[]" value="<?php echo $vec[$i]?>" />    
                        <?php
                        }
                        ?>
                        <input type="hidden" name="valor1" value="" />
                        <input type="hidden" name="valor2" value="" />
                        <input type="hidden" name="valor3" value="" />
                        <input type="submit" value="Registrar" onclick="setValor();"/>
                    </form>
                </div>
            </div>
        </div>
        <link rel="stylesheet" href="css/registro3.css">
        <script type="text/javascript" src="js/registro3.js"></script>
    </body>
    </html>