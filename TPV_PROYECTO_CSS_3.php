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
mysqli_close($connexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROYECTO</title>
    <style>
        body {
    background: linear-gradient(to bottom, #1c1c1c, #2c2c2c);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #ecf0f1;
}

.caja_titulo {
    text-align: center;
}

.titulo {
    margin: auto;
    background: linear-gradient(to right, #34495e, #2c3e50, #34495e);
    border: 2px solid #2c3e50;
    padding: 8px;
    color: #ecf0f1;
    border-radius: 6px;
}

.izquierda {
    display: inline-block;
    width: 65%;
    max-width: 900px;
    background: #2c3e50;
    text-align: center;
    border: 1px solid #444;
    box-shadow: 2px 2px 8px rgba(0,0,0,0.4);
    padding: 10px;
    border-radius: 6px;
}

.derecha {
    display: inline-block;
    background: #1e272e;
    width: 30%;
    vertical-align: top;
    text-align: center;
    border: 1px solid #444;
    box-shadow: 2px 2px 8px rgba(0,0,0,0.4);
    padding: 10px;
    border-radius: 6px;
}

.cuadrado {
    border: 1px solid #555;
    box-shadow: 2px 2px 6px rgba(0,0,0,0.5);
    display: inline-block;
    width: 120px;
    max-height: 160px;
    padding: 10px;
    background-color: #3b3b3b;
    margin: 10px;
    text-align: center;
    border-radius: 6px;
    transition: all 0.3s ease;
    color: #ecf0f1;
}

.cuadrado:hover {
    border: 1px solid #aaa;
    transform: scale(1.05);
}

img {
    width: 90%;
    height: 60%;
    border: 1px solid #666;
    border-radius: 4px;
}

.boton {
    margin: auto;
    border: 1px solid #2980b9;
    background-color: #3498db;
    color: white;
    border-radius: 20px;
    width: 80px;
    cursor: pointer;
    padding: 4px;
    transition: background-color 0.3s ease;
}

.boton:hover {
    background-color: #2980b9;
}

.linea {
    font-size: 13px;
    color: #ecf0f1;
}

.catalogo {
    margin: auto;
    display: inline-block;
    border-radius: 6px;
    background-color: #3b3b3b;
    border: 1px solid #555;
    font-size: 16px;
    padding: 6px 12px;
    font-weight: bold;
    color: #ecf0f1;
}

.titulo_lista {
    display: inline-block;
    border-radius: 6px;
    background-color: #3498db;
    color: white;
    border: 1px solid #2980b9;
    padding: 6px 12px;
    font-size: 16px;
}

.caja_lista {
    overflow-y: scroll;
    height: 300px;
    width: 90%;
    margin: 5px auto;
    padding: 5px;
    border: 1px solid #444;
    background: #2c2c2c;
    border-radius: 6px;
}

.restablecer_lista {
    display: inline-block;
    border-radius: 6px;
    background-color: #e74c3c;
    color: white;
    border: 1px solid #c0392b;
    padding: 6px 12px;
    font-size: 15px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.restablecer_lista:hover {
    background-color: #c0392b;
}

ol {
    margin-bottom: 5px;
    font-size: 13px;
    text-align: left;
    padding-left: 20px;
}

ol li:nth-child(2n-1) {
    background-color: #3b3b3b;
    border-bottom: 1px solid #555;
    padding: 4px;
}

ol li:nth-child(2n) {
    background-color: #2c2c2c;
    border-bottom: 1px solid #555;
    padding: 4px;
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