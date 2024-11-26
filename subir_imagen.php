<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=
	, initial-scale=1.0">
	<title>Document</title>
</head>

<body>


	<form enctype="multipart/form-data"  id="cargaPasteles" method="POST" autocomplete="off">
		<div class="mb-3">
			<label for="test"></label>
			<input type="text" name="test" id="test">	
		</div>
		<div class="mb-3">
			<label for="formFile" class="form-label">Cargar alguna imagen</label>
			<input class="form-control" name="imagen" type="file" id="formFile">
		</div>


		<button type="submit" name="guardar_datos" value="guardar_datos" class="btn btn-primary" id="guardar_datos">
			<span class="glyphicon glyphicon-save"></span> Guardar imagen
		</button>

	</form>

</body>
<script>
	let formNuevo = document.getElementById("cargaPasteles");
formNuevo.addEventListener("submit", (event) => {
  event.preventDefault();

  let formData = new FormData(formNuevo);

  fetch("./core/cargar.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((response) => {
      console.log(response);
    });
});
</script>

</html>