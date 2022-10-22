<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="VocêFiscal" />
  <meta name="author" content="VocêFiscal" />
  <title>VocêFiscal</title>

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
  <style>
 
        .vermelho {
            text-align: left;
            font-family: "Times New Roman", Times, serif;
            color: red;
            font-size: 13px;
        }

        .preto {
            text-align: left;
            font-family: "Times New Roman", Times, serif;
            color: black;
            font-size: 13px;
        }
        .float{
 
          width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#25d366;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:30px;
 
}

.my-float{
	margin-top:16px;
}
  </style>
 </head>

<body>


  <div class="container">
  <?php
function dataBr($data)

{

  $data = explode("-", $data);

  $data = $data[2]."/".$data[1]."/".$data[0];



  return($data);

  }
include_once "conexao.php";
$result_usuario = "SELECT * FROM ocorrencias where id = '".addslashes($_REQUEST["id"])."' ";
$resultado_usuario = mysqli_query($conn, $result_usuario);
$row_usuario = mysqli_fetch_assoc($resultado_usuario);
?>





    <div class="card bg-light">
      <article class="card-body mx-auto" style="max-width: 400px;">
        <h4 class="card-title mt-3 text-center">Veja a postagem</h4>

        <?php
          $file = new SplFileInfo($row_usuario['arquivo']);
          $extension  = strtoupper($file->getExtension());

          if ($extension == "JPG" || $extension == "JPEG" || $extension == "PNG" and $row_usuario['thumb'] != null) { ?>

            <img src="<?php echo $row_usuario['arquivo']; ?>" class="card-img" alt="<?php echo $extension; ?>">
          <?php } else {
          ?>
            <video width="320" height="240" controls>
              <source src="<?php echo $row_usuario['arquivo']; ?>" type="video/mp4">

              Não foi possivel carregar.
            </video>
          <?php
          } ?>
 
<div class="form-group input-group">
  

                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend" style="width:40%;">
                        <button onclick="history.back()" class="btn btn-primary"><span>Voltar</span></button>
                        </div>
                        <div class="input-group-prepend" style="width:40%;">
                        </div>

                        <div class="input-group-prepend" style="width:20%;">
                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=51955081075&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Varela%202.">
<a href="whatsapp://send?text=Voce conhece o VoceFiscal? Baixe agora mesmo.... colocar endereco aqui"       data-action="share/whatsapp/share"  
class="float" target="_blank">  
<i class="fa fa-whatsapp my-float"></i>
</a>
                        </div>

                    </div>

          <div class="card-body mx-auto" style="max-width: 100%;"></div>
      <p class="preto"><i class='fas fa-map'> <?php echo $row_usuario["cidade"]; ?>/<?php echo $row_usuario["estado"]; ?></i></p>
      <p class="preto"><i class='fas fa-calendar'> <?php echo dataBr($row_usuario["data"]); ?> as <?php echo $row_usuario["time"]; ?></i></p>
      <p class="preto"><i class='fas fa-user'> Postado por: <?php echo $row_usuario["nome"]; ?></i></p>
      <?php echo $row_usuario['descricao']; ?>
      </article>
    </div> <!-- card.// -->

  </div>
  <!--container end.//-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha512-YUkaLm+KJ5lQXDBdqBqk7EVhJAdxRnVdT2vtCzwPHSweCzyMgYV/tgGF4/dCyqtCC2eCphz0lRQgatGVdfR0ww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



</body>

</html>