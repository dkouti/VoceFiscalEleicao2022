<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="VocêFiscal" />
    <meta name="author" content="VocêFiscal" />
    <title>VocêFiscal</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>

<body>
    <div style="align-content: center;">
<img src="https://vocefiscal.com.br/vcfiscal/logotop.png">
    </div>
    <div class="container">


        <?php include_once "conexao.php";
        $result_contador = "SELECT count(*) as total FROM ocorrencias";
        $resultado_contador = mysqli_query($conn, $result_contador);
        $row_contador = mysqli_fetch_assoc($resultado_contador);
        ?>



        <div class="card bg-light">
            <article class="card-body mx-auto" style="max-width: 400px;">
                <h4 class="card-title mt-3 text-center">Veja as informações</h4>
                <h6 style="text-align: center;">Temos <strong><?php echo $row_contador["total"]; ?></strong> ocorrências</h6>

<?php
/*
                <h6 style="text-align: center;">Buscar:</h6>
                <form action="index.php" method="post" id="buscar" name="buscar">
            
                    <div class="form-group input-group">
              
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-search"></i> </span>
                        </div>
                        <br>
                       
                        <input name="busca" class="form-control" placeholder="Cidade,estado, nome" type="text" required>
                        <input type="submit" class="form-control" value="BUSCAR" class="btn btn-primary btn-block">
                    </div>
                </form>
*/?>
            </article>
        </div>



  


        <div class="wrapper wrapper--w680" style="justify-content: center;">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title" style="text-align: center;"> </h2>
                    <span id="conteudo"></span><br><br><br>
                </div>
            </div>
        </div>
        <script>
            var qnt_result_pg = 20; //quantidade de registro por página
            var pagina = 1; //página inicial
            $(document).ready(function() {
                listar_usuario(pagina, qnt_result_pg); //Chamar a função para listar os registros
            });

            function listar_usuario(pagina, qnt_result_pg) {
                var dados = {
                    pagina: pagina,
                    qnt_result_pg: qnt_result_pg
                }
                $.post('listar_usuario.php', dados, function(retorna) {
                    //Subtitui o valor no seletor id="conteudo"
                    $("#conteudo").html(retorna);
                });
            }
        </script>
    </div>


</html>