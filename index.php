<?php

try{
	$conexion = new PDO('mysql:host=localhost;dbname=paginacion','root','');
} catch(PDOException $e){
	echo "ERROR: " . $e->getMessage();
	die();//Por si hay algun error que no se siga mostrando nada.
}

//El signo de interrogación significa "entonces" , y ":" significa "de otra forma"
//queremos obtener el valor entero(int) de $_GET
//prreguntamos si la variable $_GET esta declarada y tiene un valor entonces tomamos el valor en su valor entero
$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
//Vamos a establecer cuantos post queremos por página
$postPorPagina = 5;
//Ejemplo 3(pagina numero 3) * 5 = 15 - 5 = 10, entnces $inicio = 10 
//y significa que vamos a traer desde el post 11 en adelante
$inicio = ($pagina > 1) ? ($pagina * $postPorPagina - $postPorPagina) : 0;

//Consulta SQL, así va cambiando dependiendo de la página donde nos encontremos
//SQL_CALC_FOUND_ROWS sirve para calcular cuantos artículos tenemos en nuestra base de datos
$articulos = $conexion->prepare("SELECT SQL_CALC_FOUND_ROWS * FROM articulos LIMIT $inicio, $postPorPagina");

//ejecuta nuestra consulta
$articulos->execute();
$articulos = $articulos->fetchAll();

//comprueba si hay artículos o no
if (!$articulos) {
	header('Location: index.php');
}

//calcula el total de artículos
//Y lo almacena, 
$totalArticulos = $conexion->query('SELECT FOUND_ROWS() as total');
$totalArticulos = $totalArticulos->fetch()['total'];

//En base al número de artículos podemos calcular el número de páginas
//redondeamos hacia arriba con ceil para que nos de un número cerrado ya que si tenemos 21 artículos dará 4.2
//Y no podrá mostral el artículo 21
$numeroPagina = ceil($totalArticulos / $postPorPagina);
//echo $numeroPagina;

//con require separamos lo que es la lógica de la vista
require 'index.view.php';

?>