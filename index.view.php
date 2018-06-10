<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Paginacion</title>
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
	<link rel="stylesheet" href="estilos.css">
</head>
<body>
	<div class="contenedor">
		<h1>Artículos</h1>
		<section class="articulos">
			<ul>
				<?php foreach ($articulos as $articulo): ?>
					<li><?php echo $articulo['ID'] . " - " . $articulo['articulo'] ?></li>
				<?php endforeach; ?>
			</ul>
		</section>

		<section class="paginacion">
			<ul><!--Establecemos el botón anterior-->
				<!-- Si la pag actual es igual a 1, lo deshabilitamos-->
				<?php if ($pagina == 1): ?>
					<li class="disabled">&laquo;</li>
				<?php else: ?>
					<!--Habilita el boton cuando avanzas-->
					<li><a href="?pagina=<?php echo $pagina - 1 ?>">&laquo;</a></li>
				<?php endif; ?>



			<!--Ejecutamos el ciclo para mostrar las páginas-->
				<?php
					for ($i=1; $i <= $numeroPagina; $i++) { 
						if ($pagina == $i) {
	//si el condicional es igual al valor, muestrame el boton con estas caracteristicas						
							echo "<li class='active'><a href='?pagina=$i'>$i</a></li>";
						}else{
							echo "<li><a href='?pagina=$i'>$i</a></li>";			
						}
					}
				?>

				<!--El boton de siguiente-->
				<?php if ($pagina == $numeroPagina): ?>
				<!--Significa que está en la última página-->
					<li class="disabled">&raquo;</li>
				<?php else: ?>
					<!--Habilita el boton cuando avanzas-->
					<li><a href="?pagina=<?php echo $pagina + 1 ?>">&raquo;</a></li>
				<?php endif; ?>

			</ul>
		</section>
	</div>
</body>
</html>