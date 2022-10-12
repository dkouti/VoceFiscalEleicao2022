<?php
//bonus630
	function con()
	{
		try
		{
			return new PDO("mysql:dbname=vocefisc_voce;host=localhost","vocefisc_voce","pfRZ{itY5rL]");
		}
		catch(PDOException $erro)
		{
			return $erro;
		}
	}
	
	function geraJsonEstados()
	{
		$query = con()->query("Select * from mapa_estado order by nome_estado",PDO::FETCH_ASSOC);
		$estados = $query->fetchAll();
		$stringJson = "{\"Estados\":[";
		for($i=0;$i<count($estados);$i++)
		{
			$stringJson .= "{\"id\":\"".$estados[$i]["cod_estado"]."\",\"nome\":\"".utf8_encode($estados[$i]["nome_estado"])."\"}";
			if($i<count($estados)-1)
				$stringJson .= ",";
		}
		$stringJson .= "]}";
		return $stringJson;
	}
	function geraJsonCidades($estadosId)
	{
		$query = con()->query("Select * from mapa_cidade where cod_estado = $estadosId order by nome_cidade");
		$cidades = $query->fetchAll();
		$stringJson = "{\"Cidades\":[";
		for($i=0;$i<count($cidades);$i++)
		{
			$stringJson .= "{\"id\":\"".$cidades[$i]["cod_cidade"]."\",\"nome\":\"".utf8_encode($cidades[$i]["nome_cidade"])."\"}";
			if($i<count($cidades)-1)
				$stringJson .= ",";
		}
		$stringJson .= "]}";
		return $stringJson;
	}
	
	header('Content-Type: application/json');
	
	if(isset($_GET["id"]))
		echo geraJsonCidades($_GET["id"]);
	else
		echo geraJsonEstados();
?>
