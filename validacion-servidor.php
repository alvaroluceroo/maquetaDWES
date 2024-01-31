<?php

include("conexion.php");


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
   } else {

        ?>

               <!--  HTML -->

        <?
   }