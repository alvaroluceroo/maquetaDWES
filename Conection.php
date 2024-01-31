<?php

include("conexion.php");

$miarray = mysqli_sql("select * from objetos");
var_dump($miarray);