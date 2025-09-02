<?php
// 2. Conexión y creación de la base de datos
$servername = "localhost";
$username = "root";
$password = "";

$connexion = mysqli_connect($servername, $username, $password);
if (!$connexion) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "connected succesfully <br>";

mysqli_set_charset($connexion, "utf8");

$crearBD = "CREATE DATABASE IF NOT EXISTS confiteria CHARACTER SET utf8";
mysqli_query($connexion, $crearBD);
mysqli_select_db($connexion, "confiteria");

$crearTabla = "CREATE TABLE IF NOT EXISTS producto( id INT AUTO_INCREMENT PRIMARY KEY,
                                                    nombre VARCHAR(100) NOT NULL,
                                                    precio DECIMAL(10,2) NOT NULL,
                                                    cantidad INT NOT NULL)";
mysqli_query($connexion,$crearTabla);

//Creamos los valores de los campos
$nombre = array("Crepes","Churros","Donut 1","Donut 2","Donut 3","Donut 4","Donut 5"," Sushi","Alitas","Papas fritas","Cupcake 1","Cupcake 2","Cupcake 3","Pastel","Bizcocho","Tarta queso","Macarrones","Yogurt","Helado 1","Helado 2","Helado 3","Helado 4","Galletas","Croissant 1","Croissant 2","Croissant 3","Empanadilla");
echo count($nombre);
$precio = array(3.00,2.50,1.10,1.50,1.30,1.80,2.00,5.20,4.00,3.10,2.10,1.00,1.75,1.55,3.00,3.75,5.50,2.15,2.40,1.80,3.10,2.75,2.20,1.20,1.80,4.00,3.00);
echo count($precio);
$cantidad = array(100,100,30,30,30,30,30,50,100,500,20,30,30,15,50,20,1000,30,100,100,100,100,50,25,25,25,30);
echo count($cantidad);

//Creamos las consultas
$consultas = [];
for ($i=0;$i<count($nombre);$i++){
    array_push($consultas, "INSERT INTO producto VALUES (NULL, '{$nombre[$i]}', {$precio[$i]}, {$cantidad[$i]})");
}
print_r ($consultas);

//Creamos los registros
$consulta = "SELECT * FROM producto";
$tabla1 = mysqli_query($connexion,$consulta);
if (mysqli_num_rows($tabla1) == 0){
    echo "No hay registros. Creando los registros con un foreach";
    foreach($consultas as $sql){
        mysqli_query($connexion,$sql);
    }
} else {
    echo "Ya hay registros";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROYECTO</title>
    <style>
        body{
            background:linear-gradient(to bottom,orange,lightyellow ,rgba(111, 253, 82, 0.7),lightblue,lightgray);
        }
        .caja_titulo{
            text-align:center;
            
        }
        .titulo{
            margin:auto;
            background:linear-gradient(to right,brown,antiquewhite,brown);
            border:2px solid darkblue;
            padding:5px;
        }
        .izquierda{
            display:inline-block;
            width:900px;
            max-width:900px;
            word-wrap:break-word;
            background: linear-gradient(to bottom right,yellow,blue,yellow);
            text-align:center;
            border: 2px inset blue;
        }
        .derecha{
            display:inline-block;
            background:linear-gradient(to bottom right,blueviolet,darkblue,blueviolet);
            width:30%;
            vertical-align:top;
            text-align:center;
            border:2px inset blueviolet;
        }
        .cuadrado{
            border: 2px inset darkolivegreen;
            box-shadow: 3px 3px 10px 1px aquamarine;
            display: inline-block;
            word-wrap:break-word;
            width: 100px;
            height: 25%;
            max-height: 150px;
            padding:5px;
            background-color:rgba(71, 214, 131,0.8);
            margin:10px;
            text-align:center;
            border-radius: 5px 5px 5px 5px;
        }
        .cuadrado:hover{
            border: 2px outset darkgreen;
        }
        img{
            width:90%;
            height:60%;
            border:2px solid darkblue;
        }
        .boton{
            margin:auto;
            border:2px inset darkgreen;
            background-color:darkseagreen;
            border-radius: 15px 15px 15px 15px;
            width:70px
        }
        .boton:hover{
            background-color:skyblue;
        }
        .linea{
            font-size: 12px;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            text-align:center;
        }
        .catalogo{
            margin:auto;
            display:inline-block;
            border-radius:7px 7px 7px 7px;
            background-color: rgba(233, 247, 44, 0.8);
            border: 2px solid lightgray;
            font-size: 16px;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            text-align:center;
            padding:5px
        }
        .titulo_lista{
            display: inline-block;
            border-radius:10px 10px 10px 10px;
            background-color:blueviolet;
            border:2px solid lightpink;
            padding:5px;
            text-align:center;
            font-size:16px;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        .caja_lista{
            overflow-y:scroll;
            height:300px;
            max-height:300px;
            width:90%;
            margin:5px;
            padding:5px;
            border:2px inset green;
            background:linear-gradient(to bottom,lightgreen,green,lightgreen)
        }
        .caja_lista:hover{
            border:2px outset green;
        }
        .restablecer_lista{
            display: inline-block;
            border-radius:10px 10px 10px 10px;
            background-color:blueviolet;
            border:2px solid lightpink;
            padding:5px;
            text-align:center;
            font-size:16px;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        .restablecer_lista:hover{
            border:2px solid darkmagenta; 
        }
        ol{
            margin-bottom: 5px;
            font-size:12px
        }
        ol li:nth-child(2n-1){
            background-color:yellow;
            border: 2px solid gray;
        }
        ol li:nth-child(2n){
            background-color:lightseagreen;
            border: 2px solid gray;
        }

    </style>
</head>
<body>
    <div class="caja_titulo">
    <h1 class="titulo">Tienda virtual<h1>
    </div>
    <div class="izquierda">
        <p class="catalogo">Catalogo de articulos</p> <br>
        <div class="cuadrado">
            <img src="logo.jpg">
            <p class="linea" id="nombre">Napolitana</p>
            <div class="boton" id="boton">
                <p class="linea">Pedir</p>
            </div>
        </div>
        </div>
    <div class="derecha">
        <p class="titulo_lista">Lista de articulos pedidos</p>
        <hr>
        <div class="caja_lista">
          <ol class="lista" id="lista">
          </ol>
        
        </div>
        <p class="restablecer_lista" id="restablecer"> Restablecer </p>
        <p> Holi </p>
     </div>

     <script>
        function añadir_lista(){
            document.getElementById("lista").innerHTML += "<li>" + document.getElementById("nombre").innerText + "</li>"  
        }
        document.getElementById("boton").onclick = añadir_lista;
        function restablecer_lista(){
            document.getElementById("lista").innerHTML = "";
        }
        document.getElementById("restablecer").onclick = restablecer_lista;
     </script>
</body>
</html>