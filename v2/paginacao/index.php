<!DOCTYPE HTML>
<html lang="pt-br">  
    <head>  
        <meta charset="utf-8">
        <title>VoceFiscal</title>
 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

		    <!-- Icons font CSS-->
		<link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    </head>
    <body>
		<div class="wrapper wrapper--w680" style="justify-content: center;">
        <div class="card card-4">
            <div class="card-body">
                <h2 class="title" style="text-align: center;"> </h2>
                        <span id="conteudo"></span><br><br><br>
		</div>
				</div>
</div>
		<script>
			var qnt_result_pg = 10; //quantidade de registro por página
			var pagina = 1; //página inicial
			$(document).ready(function () {
				listar_usuario(pagina, qnt_result_pg); //Chamar a função para listar os registros
			});
			
			function listar_usuario(pagina, qnt_result_pg){
				var dados = {
					pagina: pagina,
					qnt_result_pg: qnt_result_pg
				}
				$.post('listar_usuario.php', dados , function(retorna){
					//Subtitui o valor no seletor id="conteudo"
					$("#conteudo").html(retorna);
				});
			}
		</script>
    </body>
</html>
