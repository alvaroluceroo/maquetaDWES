<?php
include ("conexion.php");


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metedura de objetos en la data de base</title>
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
                <h1>La planeta es ingresada</h1>
            </div>
        </div>
        <h2>Esto te mete el planeta y tal</h2>
    </header>

    <main>
        <div class="btnhome"><a href="index.html">[ home ]</a></div>
        <?php
if(!$_POST){

?>
        <form action="" method="POST" onsubmit="return validar(this)">
            <div class="seccion">Datos opjeto</div>
            <div class="formfield">
                <div class="titfield">Nombre</div><label> <input type="text" name="nombre" class="camp" /></label>
            </div>
            <div class="formfield">
                <div class="titfield">Distancia</div><label> <input type="text" name="distancia" class="camp" /></label>
            </div>
            <div class="formfield"> Tipo de objeto
                <select name="tipo" id="" class="camp">
                    <option value="1">Interior</option>
                    <option value="2">Exterior</option>
                    <option value="3">Satelite</option>
                </select>
            </div>
            <br clear="both">
            <div class="formfield"><input type="submit" name="enviar" class="camp" /></div>
        </form>
        <?php 
} else {
 
   $enviado = $_POST['nombre'] ?? false;

   if ($enviado) {

       $validado = true;
       $msgerror = '';

       $todos = filter_input_array(INPUT_POST); // FILTRA TODOS (los mete en array $todos)

       if ($validado) {

           $sql = "insert into objetos (nombre,distancia,tipo_id) values (
           '" . $todos['nombre'] . "',
           '" . $todos['distancia'] . "',
           '" . $todos['tipo'] . "'
           )";


           mysqli_sql($sql, true);


       } else {
           print '<script>alert("' . $msgerror . '");history.go(-1)</script>';
       }
}
}?>
    </main>

    <footer>
        <div class="content bottom">
            <img src="img/logo.svg" alt="">

            <div style="position: relative; left:80%; bottom: 30px; "><img src="img/palabottom.svg" alt=""></div>
        </div>
    </footer>

</body>

</html>