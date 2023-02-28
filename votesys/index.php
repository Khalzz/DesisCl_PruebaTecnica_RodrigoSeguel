<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoteSys</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="./controllers/votante/add.php" method="post"  id="form">
        <label for="nombre_completo">Nombre y apellido:</label>
		<input type="text" id="nombre_completo" name="nombre_completo" placeholder="Rodrigo Seguel"><br>
        <label for="alias">Alias:</label>
		<input type="text" id="alias" name="alias" placeholder="Rodrigo123"><br>
        <label for="rut">Rut:</label>
		<input placeholder="12345678-9" type="text" id="rut" name="rut"><br>
        <label for="email">Email:</label>
		<input type="email" id="email" name="email" placeholder="Rodrigo@correo.com"><br>

        <label for="region_id">Region:</label>
		<select name="region_id" required id="region">
			<option value="" selected disabled hidden>Choose a region</option>
			<?php 
				include 'controllers/region/list.php'; 
			?>
		</select><br>

		<label for="comuna_id">Comuna:</label>
		<select name="comuna_id" required id="comuna" disabled="false">
			<option value="" selected disabled hidden>Choose a comuna</option>
		</select><br>

		<label for="candidato_id">Candidato:</label>
		<select name="candidato_id" required id="candidato">
			<option value="" selected disabled hidden>Choose a candidato</option>
			<?php 
				include 'controllers/candidato/list.php'; 
			?>
		</select><br>

		<ul id=list-knew>
			<label for="origen">Como se entero de nosotros?</label>
			<li><input type="checkbox" name="conocido" value="Web"> Web</li>
			<li><input type="checkbox" name="conocido" value="Tv"> Tv</li>
			<li><input type="checkbox" name="conocido" value="Redes sociales">Redes sociales</li>
			<li><input type="checkbox" name="conocido" value="Amigo">Amigo</li>
		</ul>
		<br>
		<div id="errorMessage" >
			<p>Hay un error en su formulario</p>
		</div>
        <input type="submit" value="Submit" id="send">
    </form>

	<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
	<script src="index.js"></script>
</body>
</html>