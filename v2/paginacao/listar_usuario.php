<?php
include_once "conexao.php";

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
//calcular o inicio visualização
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

//consultar no banco de dados
$result_usuario = "SELECT * FROM ocorrencias ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
$resultado_usuario = mysqli_query($conn, $result_usuario);

function dataBr($data)

	{

		$data = explode("-", $data);

		$data = $data[2]."/".$data[1]."/".$data[0];



		return($data);

    }
//Verificar se encontrou resultado na tabela "usuarios"
if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
	?>

			<?php
			while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
				?>
					<div class="card mb-3" style="max-width: 540px;justify-content: center;">
  <div class="row no-gutters">
    <div class="col-md-4">


		<?php
		             $file = new SplFileInfo($row_usuario['arquivo']);
								 $extension  = strtoupper($file->getExtension());

if ($extension == "JPG" || $extension == "JPEG" || $extension == "PNG" and $row_usuario['thumb'] != null){?>

 <a href="lista.php?id=<?php echo $row_usuario['id'];?>"><img src="<?php echo $row_usuario['thumb'];?>" class="card-img" alt="<?php echo $extension;?>" width="200" height="250"></a>
<?php } else {
	?>
  <a href="lista.php?id=<?php echo $row_usuario['id'];?>"><img src="https://vocefiscal.com.br/v2/images.png" class="card-img" alt="<?php echo $extension;?>" width="200" height="250"></a>
	<?php
}?>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $row_usuario["nome"];?></h5>
				<?php
$textox = $row_usuario['descricao'];
                 
if (strlen($textox) > 120){
$textox = substr($textox, 0, 60) . '...';
}?>

        <p class="card-text"><?php echo $textox;?></p>
 
        <p class="card-text"><small class="text-muted"><?php echo $row_usuario["cidade"];?>/<?php echo $row_usuario["estado"];?><br><?php echo dataBr($row_usuario["data"]);?> as <?php echo $row_usuario["time"];?></small></p>
      </div>
    </div>
  </div>
</div>
 
				<?php
			}?>

	<?php
	//Paginação - Somar a quantidade de usuários
	$result_pg = "SELECT COUNT(id) AS num_result FROM ocorrencias";
	$resultado_pg = mysqli_query($conn, $result_pg);
	$row_pg = mysqli_fetch_assoc($resultado_pg);

	//Quantidade de pagina
	$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

	//Limitar os link antes depois
	$max_links = 5;

	echo '<nav aria-label="paginacao">';
	echo '<ul class="pagination">';
	echo '<li class="page-item">';
	echo "<span class='page-link'><a href='#' onclick='listar_usuario(1, $qnt_result_pg)'>Primeira</a> </span>";
	echo '</li>';
	for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
		if($pag_ant >= 1){
			echo "<li class='page-item'><a class='page-link' href='#' onclick='listar_usuario($pag_ant, $qnt_result_pg)'>$pag_ant </a></li>";
		}
	}
	echo '<li class="page-item active">';
	echo '<span class="page-link">';
	echo "$pagina";
	echo '</span>';
	echo '</li>';

	for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
		if($pag_dep <= $quantidade_pg){
			echo "<li class='page-item'><a class='page-link' href='#' onclick='listar_usuario($pag_dep, $qnt_result_pg)'>$pag_dep</a></li>";
		}
	}
	echo '<li class="page-item">';
	echo "<span class='page-link'><a href='#' onclick='listar_usuario($quantidade_pg, $qnt_result_pg)'>Última</a></span>";
	echo '</li>';
	echo '</ul>';
	echo '</nav>';

}else{
	echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
}
