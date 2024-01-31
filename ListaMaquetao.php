

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
include ("conexion.php");


        $sql = "select * from objetos";


        $arr = mysqli_sql($sql, false);
        echo "<section class=\"columnas\">";
        foreach ($arr as $objeto){
            $nombre = $objeto['nombre'];
            $distancia = $objeto['distancia'];
            $tipo = $objeto["tipo_id"];
            if ($tipo==1) {
                echo "<section class=\"moduloplaneta\"><h3>$nombre</h3><img src='img/".davidtehaspasao($nombre).".jpg'><p>$nombre es un planeta de tipo rocoso situado a una distancia de $distancia dela tierra</p></section>";
            } elseif ($tipo == 2) {
                echo "<section class=\"moduloplaneta\"><h3>$nombre</h3><img src='img/".davidtehaspasao($nombre).".jpg'><p>$nombre es un planeta de tipo gasioso situado a una distancia de $distancia dela tierra</p></section>";
            }   else {
                echo "<section class=\"moduloplaneta\"><h3>$nombre</h3><img src='img/".davidtehaspasao($nombre).".jpg'><p>$nombre es un Sateite</p></section>";
            }
            davidtehaspasao($nombre);
            echo "</br>";
        }

        echo "</section>";

        function davidtehaspasao($cosa){
            $rutaytal = "img/".ucfirst($cosa).".jpg";

            if (file_exists($rutaytal)) {
                return ucfirst($cosa);
            } else {
                return "hexagon";
            }
        }

?>
        
    </main>

    <footer>
        <div class="content bottom">
            <img src="img/logo.svg" alt="">

            <div style="position: relative; left:80%; bottom: 30px; "><img src="img/palabottom.svg" alt=""></div>
        </div>
    </footer>

</body>

</html>