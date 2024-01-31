<?php
include ("conexion.php");

/* if ($_POST) {
    foreach ($_POST as $key => $value){
        echo $key. ': '. $value. '<br>';
    }
}

session_start();
$_SESSION["logado"] = true;
 */
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
                <h1>Registro de usuario en app Planetario</h1>
            </div>
        </div>
        <h2>Formulario de registro de usuario en la BDD planetario con Validación en servidor</h2>
    </header>

    <main>
        <div class="btnhome"><a href="index.html">[ home ]</a></div>
        <?php
if(!$_POST){

?>
        <form action="" method="POST" onsubmit="return validar(this)">
            <div class="seccion">Datos personales</div>
            <div class="formfield">
                <div class="titfield">Nombre</div><label> <input type="text" name="nombre" class="camp" /></label>
            </div>
            <div class="formfield">
                <div class="titfield">Apellido 1</div><label> <input type="text" name="apellido1" class="camp" /></label>
            </div>      
            <div class="formfield">
                <div class="titfield">Apellido 2</div><label> <input type="text" name="apellido2" class="camp" /></label>
            </div> 
            <div class="formfield">
                <div class="titfield">Email</div><label> <input type="email" name="email" class="camp" /></label>
            </div> 
            <div class="formfield mid">
                <div class="titfield">Fecha de alta</div><label> <input type="date" name="fecha_alta" class="camp" /></label>
            </div> 
            <div class="formfield mid">
                <div class="titfield">Teléfono</div><label> <input type="text" name="telefono" class="camp" /></label>
            </div> 
            
            <br clear="both">
            <div class="seccion">Datos login</div>
            <div class="formfield">
                <div class="titfield">nick</div><label> <input type="text" name="nick" class="camp" /></label>
            </div>
            <div class="formfield">
                <div class="titfield">password</div><label> <input type="password" name="pwd" class="camp" /></label>
            </div>
            <div class="formfield">
                <input class="titfield" type="checkbox" name="gr1" id="checkbox" required onchange="verificarCheckbox()"> Acepto el acuerdo de confidencialidad
            </div>

            <br clear="both">
            <div class="formfield"><input type="submit" name="enviar" class="camp" /></div>
        </form>
        <?php 
} else {
    function is_number($number, int $min = 0, int $max = 10): bool
   {
       return ($number >= $min and $number <= $max);
   }

   function str_text($text, int $min = 0, int $max = 1000): bool
   {
       $length = mb_strlen($text);
       return ($length >= $min and $length <= $max);
   }

   function es_password(string $pwd): bool
   {
       if (
           mb_strlen($pwd) >= 8 and preg_match('/[A-Z]/', $pwd)
           and preg_match('/[a-z]/', $pwd)
           and preg_match('/[0-9]/', $pwd)
           and !preg_match("/\\s/", $pwd)
       ) {
           return true;
       }
       return false;
   }

   function es_email($str)
   {
       //$coincide = null;
       //return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $str, $coincide));
       return (false !== filter_var($str, FILTER_VALIDATE_EMAIL));

   }


   $enviado = $_POST['nombre'] ?? false;

   if ($enviado) {

       $validado = true;
       $msgerror = '';
       //
       // procedimiento de validación en servidor
       //


       //
       // filtrado 
       //
       //$pwd = filter_input(INPUT_POST, 'pwd'); // FILTRA UN CAMPO

       $todos = filter_input_array(INPUT_POST); // FILTRA TODOS (los mete en array $todos)
       // $selplaneta = filter_input(INPUT_POST, 'planetas');

       //
       // comprobar password con función es_password
       //
       if ($validado) {
           if (!es_password($todos['pwd'])) {
               $msgerror = 'password no valida';
               $validado = false;
           }
       }

       
       //
       // comprobar telefono tenga 9 caracteres mínimo
       //
       if ($validado) {
           if (!str_text($todos['telefono'],8,12)) {
               $msgerror = 'teléfono no valido';
               $validado = false;
           }
       }

       //
       // comprobar si es email
       //

       if ($validado) {
           if (!es_email($todos['email'])) {
               $msgerror = 'email no válido';
               $validado = false;
           }
       }

       /*if($validado){
           $seleccionado = in_array($selplaneta, $planetas);
           if(!$seleccionado) {
               $msgerror = 'El planeta seleccionado no se encuentra entre los posibles';
               $validado = false;
           }
       }*/

       //
       // codificar pass con md5
       //
       $pwdcod = md5($todos['pwd']);

       if ($validado) {

           $sql = "insert into usuario (id,nick,pwd,nombre,apellido1,apellido2,email,telefono,fecha_alta) values ('',
           '" . $todos['nick'] . "',
           '" . $pwdcod . "',
           '" . $todos['nombre'] . "',
           '" . $todos['apellido1'] . "',
           '" . $todos['apellido2'] . "',
           '" . $todos['email'] . "',
           '" . $todos['telefono'] . "',
           '" . $todos['fecha_alta'] . "'
           )";


           $insertar = mysqli_sql($sql, true);

           print 'DATOS CORRECTOS - registro guardado';
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