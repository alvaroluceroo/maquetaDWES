

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

        foreach ($arr as $objeto){
            foreach ($objeto as $key => $value) {
                echo "$key: $objeto[$key] </br>";
            }
            echo "</br>";
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