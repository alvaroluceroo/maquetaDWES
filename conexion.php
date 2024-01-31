<?php
/**
 * Métodos de conexión con BDD en funciones y en objeto ®
 * Formación Profesional Superior ESIC
 * 
 * - Proceduralmente con mysqli
 * - Como objeto mysqli
 * - Como objeto PDO
 * 
 * - Objeto contenedor de todas las formas de conexión
 */


 session_start();

if (str_contains($_SERVER["PHP_SELF"], "form.php") ==false && str_contains($_SERVER["PHP_SELF"], "login.php") ==false) {
    if(!isset($_SESSION["logado"]) or $_SESSION["logado"] != true) header ("Location: login.php");
}

define('hostnameBDD', 'localhost');
define('usernameBDD', 'root');
define('passwordBDD', '');
define('databaseBDD', 'planetario');

//
// iniciar sesión 
//

//
// 1.- Conexión con BDD con mysqli proceduralmente
//
function mysqli_sql($cadenaSQL, $sinretorno = false)
{


    // Abrir bdd y establecer conexión
    $conexionBDD = mysqli_connect(hostnameBDD, usernameBDD, passwordBDD, databaseBDD) or die("Error: " . mysqli_error($conexionBDD));

    // Ejecutar SQL
    $resultadoBDD = mysqli_query($conexionBDD, $cadenaSQL) or die("Error: " . mysqli_error($conexionBDD));//print mysqli_error($conexionBDD); //


    // Con un while podremos recorrer el resultado
    if (!$sinretorno) {
        $listado = array();
        while ($filaBDD = mysqli_fetch_assoc($resultadoBDD)) $listado[] = $filaBDD;
        // Liberar resultado
        mysqli_free_result($resultadoBDD);
    }

    // Cerrar conexión
    mysqli_close($conexionBDD);

    if (!$sinretorno) return $listado;
}


//
// 2.- Conexión con BDD con mysqli como objeto
//
function mysqli_obj_sql($cadenaSQL, $sinretorno = false)
{
    //crear instancia objeto que conecta
    $mysqli = new mysqli(hostnameBDD, usernameBDD, passwordBDD, databaseBDD);

    //chequeo de errores
    if ($mysqli->connect_errno) {
        echo "Falló la conexión con MySQL: " . $mysqli->connect_error;
    }

    //mandar query 
    $res = $mysqli->query($cadenaSQL);

    //manejar error
    if ($mysqli->error) {
        print $mysqli->error;
        return false;
    }

    //fetch query
    if (!$sinretorno) {
        $listado = array();
        while ($filaBDD = $res->fetch_assoc()) $listado[] = $filaBDD;
    }

    //returnea resultado
    if (!$sinretorno) return $listado;
}


