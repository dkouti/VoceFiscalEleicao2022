<!DOCTYPE html>
<html lang="en">

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Colorlib Templates">
  <meta name="author" content="Colorlib">
  <meta name="keywords" content="Colorlib Templates">
  <title>VoceFiscal.com.br</title>
  <link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
  <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
  <script src="../jquery-2.1.1.min.js"></script>
  <link href="../css/main.css" rel="stylesheet" media="all">
  <style>
    .p1 {
      font-family: "Times New Roman", Times, serif;
      color: red;
      font-size: 12px;
      text-align: center;
    }

    .btn {
      position: relative;

      display: block;
      margin: 30px auto;
      padding: 0;

      overflow: hidden;

      border-width: 0;
      outline: none;
      border-radius: 2px;
      box-shadow: 0 1px 4px rgba(0, 0, 0, .6);

      background-color: #2ecc71;
      color: #ecf0f1;

      transition: background-color .3s;
    }

    .btn>* {
      position: relative;
    }

    .btn span {
      display: block;
      padding: 12px 24px;
    }
  </style>

</head>

<body>
  <?php
  function dataBr($data)

  {

    $data = explode("-", $data);

    $data = $data[2] . "/" . $data[1] . "/" . $data[0];



    return ($data);
  }
  include_once "conexao.php";
  $result_usuario = "SELECT * FROM ocorrencias where id = '" . addslashes($_REQUEST["id"]) . "' ";
  $resultado_usuario = mysqli_query($conn, $result_usuario);
  $row_usuario = mysqli_fetch_assoc($resultado_usuario);
  ?>

  <div class="wrapper wrapper--w680">

    <div class="card card-4">
      <div class="card-body">


        <div class="card" style="width: 100%;">

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
          <div class="card-body">
            <button onclick="history.back()" class="btn"><span>Voltar</span></button>
            <p class="card-text"><small class="text-muted"><br><?php echo $row_usuario["cidade"]; ?>/<?php echo $row_usuario["estado"]; ?> - <?php echo dataBr($row_usuario["data"]); ?> as <?php echo $row_usuario["time"]; ?><br><strong>Postado por: <?php echo $row_usuario["nome"]; ?></strong></small></p>
            <p class="card-text"><?php echo $row_usuario['descricao']; ?></p>

          </div>
        </div>

      </div>
    </div>
  </div>


  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/select2/select2.min.js"></script>
  <script src="../js/global.js"></script>
  <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha512-YUkaLm+KJ5lQXDBdqBqk7EVhJAdxRnVdT2vtCzwPHSweCzyMgYV/tgGF4/dCyqtCC2eCphz0lRQgatGVdfR0ww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>