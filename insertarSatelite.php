<?php
include ("conexion.php");
// if ($_SESSION['logado'] != true)header("Location: login.php");

// if ($_POST) {
//     foreach ($_POST as $key => $value){
//         echo $key. ': '. $value. '<br>';
//     }
// }

// session_start();
// $_SESSION["logado"] = true;

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario en app Planetario</title>
    <link href="css/estilos.css" rel="stylesheet" type="text/css">
    <link href="css/form.css" rel="stylesheet" type="text/css">

    <link rel="icon" type="image/png" href="img/favicon.png" />

</head>

<body>
    <header>
        <div class="content" style="margin-top:40px; margin-bottom:20px"> <img src="img/palatop.svg"></div>

        
        <div id="fondoA" class="completa" style="background-image: url('img/office.jpg');">
            <div class="cab">
                <h2>DWES</h2>
                <h1>Insertar Satélite</h1>
            </div>
        </div>
    </header>

    <main>
        <div class="btnhome"><a href="../">[ home ]</a></div>
        <div class="formfield">
            Objeto Padre:
            <select class="camp"  name="tipo" id="">
                
        </div>
        <?php 
            $listado = mysqli_sql("select*from objetos");

            foreach ($listado as $object){
                if ($object['tipo_id'] < 3) {
                    // echo $object["tipo_id"];
                    echo "<option value=\"{$object['id']}\">{$object['nombre']}</option>";
                }
            }
        
        ?>
        </select>

        <div class="formfield">
            Objeto Hijo:
            <select class="camp"  name="tipo" id="">
                
        </div>
        <?php 
            $listado = mysqli_sql("select*from objetos");

            foreach ($listado as $object){
                if ($object['tipo_id'] == 3) {
                    echo "<option value=\"{$object['id']}\">{$object['nombre']}</option>";
                }
            }
        
        ?>
        </select>
        <form action="" method="POST" onsubmit="return validar(this)">
            
                <!-- <div class="titfield">Tipo de objetos</div><label> <input type="text" name="tipo" class="camp" /></label> -->

            
            <br clear="both">
            <div class="formfield"><input type="submit" name="enviar" class="camp" /></div>
        </form>
    </main>

    <footer>
        <div class="content bottom">
            <img src="img/logo.svg" alt="">

            <div style="position: relative; left:80%; bottom: 30px; "><img src="img/palabottom.svg" alt=""></div>
        </div>
    </footer>

</body>

</html>