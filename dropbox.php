<html>
<head>
	<title>Dropbox JavaScript SDK</title>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	<script src="script/Dropbox-sdk.min.js"></script> 
</head>
<body>
	<section class="container main">
		<form onSubmit="return uploadFile()">
			<input type="text" id="numeroSiniestro" placeholder="Numero de siniestro" required="true" />
			<input type="file" id="file-upload" required="true" accept="image/*"/>
			<button class="btn waves-effect waves-light" type="submit" name="action">Enviar foto</button>
		</form>

		<!-- A place to show the status of the upload -->
		<h2 id="results"></h2>
	</section>

	<script>
		function uploadFile() {
			var numeroSiniestro = document.getElementById('numeroSiniestro').value;
			var dbx = new Dropbox({ accessToken: "MY1nVgonrBAAAAAAAAAACzJYPIzn8ALYJH2HIp8-cwh0kjwg2UyMnzhL7CnWsls_" });
			var fileInput = document.getElementById('file-upload');
			var file = fileInput.files[0];
			dbx.filesUpload({path: '/'+numeroSiniestro+ '/' + file.name, contents: file})
			.then(function(response) {
				var results = document.getElementById('results');
				results.appendChild(document.createTextNode('File uploaded!'));
				console.log(response);
			})
			.catch(function(error) {
				console.error(error);
			});
			return false;
		}
	</script>
</body>
</html>
