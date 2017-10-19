<?php
//Exibe erros PHP
@ini_set('display_errors', '1');
error_reporting(E_ALL); 
require "../funcoes/funcoesConecta.php";
require "../funcoes/funcoesGerais.php";

$con = bancoMysqli();
set_time_limit(0);
//$teste = " LIMIT 0,100";
$teste = " ";

if(isset($_GET['action'])){
	$action = $_GET['action'];
}else{
	$action = "inicio";
}

switch($action){

	/////// Biblioteca
	case "biblioteca":
	
	$antes = strtotime(date('Y-m-d H:i:s')); // note que usei hífen
	echo "<h1>Gerando os registros da Biblioteca...</h1><br />";
	$hoje = date('Y-m-d H:i:s');

	// apaga todos os registros da biblioteca
	$sql = "DELETE FROM acervo_index WHERE acervo = 1";
	$query = mysqli_query($con,$sql);
	if($query){
		// insere nova base
		$sql_select = "SELECT TIT_ID,COL_COMUM FROM alx_geral $teste";
		$query_select = mysqli_query($con,$sql_select);
		while($biblio = mysqli_fetch_array($query_select)){
			$id = $biblio['TIT_ID'];
			$comum = $biblio['COL_COMUM'];
			$acervo = 1;
			$sql_insert = "INSERT INTO `acervo_index` (`id`, `acervo`, `idAcervo`, `comum`) VALUES (NULL, '$acervo', '$id', '$comum')";
			$query_insert = mysqli_query($con,$sql_insert);
			if($query_insert){
				echo $comum." inserido com sucesso.<br />";	
			}else{
				echo "Erro(1). $sql_insert<br />";		
			}
		}
	}else{
			echo "Erro(2)";	
	}	






	$depois = strtotime(date('Y-m-d H:i:s'));
	$tempo = $depois - $antes;
	echo "<br /><br /> Importação executada em $tempo segundos";
	
	break;

	
	/////// GRAVADORAS
	case "artes":

	$antes = strtotime(date('Y-m-d H:i:s')); // note que usei hífen
	echo "<h1>Gerando os registros do Acervo de Artes...</h1><br />";
	$hoje = date('Y-m-d H:i:s');

	// apaga todos os registros da biblioteca
	$sql = "DELETE FROM acervo_index WHERE acervo = 2";
	$query = mysqli_query($con,$sql);
	if($query){
		// insere nova base
		$sql_select = "SELECT id, ano_obra,titulo, tecnica, autor FROM temp_artes $teste";
		$query_select = mysqli_query($con,$sql_select);
		while($artes = mysqli_fetch_array($query_select)){
			$id = $artes['id'];
			$comum = strtoupper($artes['ano_obra']." ".$artes['titulo']." ".$artes['tecnica']." ".$artes['autor']);
			$acervo = 2;
			$sql_insert = "INSERT INTO `acervo_index` (`id`, `acervo`, `idAcervo`, `comum`) VALUES (NULL, '$acervo', '$id', '$comum')";
			$query_insert = mysqli_query($con,$sql_insert);
			if($query_insert){
				echo $comum." inserido com sucesso.<br />";	
			}else{
				echo "Erro(1). $sql_insert<br />";		
			}
		}
	}else{
			echo "Erro(2)";	
	}	
	
	
	$depois = strtotime(date('Y-m-d H:i:s'));
	$tempo = $depois - $antes;
	echo "<br /><br /> Importação executada em $tempo segundos";


break;

	/////////// Forma e Gênero
	case "museu":
	$antes = strtotime(date('Y-m-d H:i:s')); // note que usei hífen
	echo "<h1>Gerando os registros do Acervo do Museu...</h1><br />";
	$hoje = date('Y-m-d H:i:s');

	// apaga todos os registros da biblioteca
	$sql = "DELETE FROM acervo_index WHERE acervo = 3";
	$query = mysqli_query($con,$sql);
	if($query){
		// insere nova base
		$sql_select = "SELECT id, DS_NOME, DS_OUTRO_NOME, DS_TITULO, DS_LEGENDA, DS_DESCRICAO  FROM temp_museu $teste";
		$query_select = mysqli_query($con,$sql_select);
		while($artes = mysqli_fetch_array($query_select)){
			$id = $artes['id'];
			$comum = strtoupper($artes['DS_NOME']." ".$artes['DS_OUTRO_NOME']." ".$artes['DS_TITULO']." ".$artes['DS_LEGENDA']." ".$artes['DS_DESCRICAO']);
			$acervo = 3;
			$sql_insert = "INSERT INTO `acervo_index` (`id`, `acervo`, `idAcervo`, `comum`) VALUES (NULL, '$acervo', '$id', '$comum')";
			$query_insert = mysqli_query($con,$sql_insert);
			if($query_insert){
				echo $comum." inserido com sucesso.<br />";	
			}else{
				echo "Erro(1). $sql_insert<br />";		
			}
		}
	}else{
			echo "Erro(2)";	
	}	
	
	
	$depois = strtotime(date('Y-m-d H:i:s'));
	$tempo = $depois - $antes;
	echo "<br /><br /> Importação executada em $tempo segundos";	
	break;

	/////////// Meios de Expressão
	case "meios":
	$antes = strtotime(date('Y-m-d H:i:s')); // note que usei hífen
	echo "<h1>Importando os termos adotados para Meios de expressão...</h1><br />";
	$hoje = date('Y-m-d H:i:s');
	$sql = "SELECT DISTINCT Adotar FROM temp_meio $teste";
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		$gravadora = addslashes($x['Adotar']);
		$sql_update = "INSERT INTO `acervo_termo` (`termo`, `adotado`, `tipo`, `categoria`, `pesquisa`, `id_usuario`, `data_update`, `publicado`) 
		VALUES ('$gravadora', '', '13', '', 'Base antiga', '1', '$hoje', '1')";
		$query_update = mysqli_query($con,$sql_update);
		if($query_update){
			echo "Meio de expressão $gravadora inserida. (1) <br />";	
		}else{
			echo "Erro ao importar $gravadora (2) <br />";
			
		}
	}
	
	echo "<h1>Importando os demais termos...</h1>";
	
	$hoje = date('Y-m-d H:i:s');
	$sql = "SELECT DISTINCT Termo FROM `temp_meio` $teste";
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		$gravadora = addslashes($x['Termo']);
		$sql_busca = "SELECT * FROM acervo_termo WHERE termo LIKE '$gravadora' AND tipo = '13'";
		$query_busca = mysqli_query($con,$sql_busca);
		$num_busca = mysqli_num_rows($query_busca);

		if($num_busca == 0){
			$sql_update = "INSERT INTO `acervo_termo` (`termo`, `adotado`, `tipo`, `categoria`, `pesquisa`, `id_usuario`, `data_update`, `publicado`) 
			VALUES ('$gravadora', '', '13', '', 'Base antiga', '1', '$hoje', '1')";
			$query_update = mysqli_query($con,$sql_update);
			if($query_update){
				echo "Meio de Expressão $gravadora inserido. (3) <br />";	
			}else{
				echo "Erro ao importar $gravadora (4) <br /> ";
			}
	
		}
	}
	echo "<h1>Atualizando os termos preteridos</h1>";
	$hoje = date('Y-m-d H:i:s');
	$sql = "SELECT * FROM temp_meio $teste";
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		$termo = $x['Termo'];
		$adotar = $x['Adotar'];
		if($termo != $adotar){
			$adotar = addslashes($x['Adotar']);
			$sql_busca = "SELECT id_termo FROM acervo_termo WHERE termo LIKE '$adotar' AND tipo ='13'";
			$query_busca = mysqli_query($con,$sql_busca);
			$y = mysqli_fetch_array($query_busca);
			$id = $y['id_termo'];
			$sql_atualiza = "UPDATE acervo_termo SET adotado = '$id' WHERE termo LIKE '$termo'";
			$query_atualiza = mysqli_query($con,$sql_atualiza);
			if($query_atualiza){
				echo "Meio de expressão $termo adota o termo $adotar(5)<br />";	
			}else{
				echo "Erro ao atualizar o termo $termo / $adotar(6)<br />";	
			}
		}	
		
	}
	$depois = strtotime(date('Y-m-d H:i:s'));
	$tempo = $depois - $antes;
	echo "<br /><br /> Importação executada em $tempo segundos";
	
	break;

	/////////// Autoridades
	case "autoridades":
	$antes = strtotime(date('Y-m-d H:i:s')); // note que usei hífen
	echo "<h1>Importando os termos adotados para Autoridades...</h1><br />";
	$hoje = date('Y-m-d H:i:s');
	$sql = "SELECT DISTINCT Adotar FROM acervo_autoridades $teste";
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		$gravadora = addslashes($x['Adotar']);
		$sql_update = "INSERT INTO `acervo_termo` (`termo`, `adotado`, `tipo`, `categoria`, `pesquisa`, `id_usuario`, `data_update`, `publicado`) 
		VALUES ('$gravadora', '', '1', '', 'Base antiga', '1', '$hoje', '1')";
		$query_update = mysqli_query($con,$sql_update);
		if($query_update){
			echo "Autoridade $gravadora inserida. (1) <br />";	
		}else{
			echo "Erro ao importar $gravadora (2) <br />";
			
		}
	}
	
	echo "<h1>Importando os demais termos...</h1>";
	
	$hoje = date('Y-m-d H:i:s');
	$sql = "SELECT DISTINCT Termo FROM `acervo_autoridades` $teste";
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		$gravadora = addslashes($x['Termo']);
		$sql_busca = "SELECT * FROM acervo_termo WHERE termo LIKE '$gravadora' AND tipo = '1'";
		$query_busca = mysqli_query($con,$sql_busca);
		$num_busca = mysqli_num_rows($query_busca);

		if($num_busca == 0){
			$sql_update = "INSERT INTO `acervo_termo` (`termo`, `adotado`, `tipo`, `categoria`, `pesquisa`, `id_usuario`, `data_update`, `publicado`) 
			VALUES ('$gravadora', '', '1', '', 'Base antiga', '1', '$hoje', '1')";
			$query_update = mysqli_query($con,$sql_update);
			if($query_update){
				echo "Autoridade $gravadora inserido. (3) <br />";	
			}else{
				echo "Erro ao importar $gravadora (4) <br /> ";
			}
	
		}
	}
	echo "<h1>Atualizando os termos preteridos</h1>";
	$hoje = date('Y-m-d H:i:s');
	$sql = "SELECT Termo,Adotar FROM acervo_autoridades $teste";
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		$termo = $x['Termo'];
		$adotar = $x['Adotar'];
		if($termo != $adotar){
			$adotar = addslashes($x['Adotar']);
			$sql_busca = "SELECT id_termo FROM acervo_termo WHERE termo LIKE '$adotar' AND tipo ='1'";
			$query_busca = mysqli_query($con,$sql_busca);
			$y = mysqli_fetch_array($query_busca);
			$id = $y['id_termo'];
			$sql_atualiza = "UPDATE acervo_termo SET adotado = '$id' WHERE termo LIKE '$termo'";
			$query_atualiza = mysqli_query($con,$sql_atualiza);
			if($query_atualiza){
				echo "Autoridade $termo adota o termo $adotar(5)<br />";	
			}else{
				echo "Erro ao atualizar o termo $termo / $adotar(6)<br />";	
			}
		}	
		
	}
	$depois = strtotime(date('Y-m-d H:i:s'));
	$tempo = $depois - $antes;
	echo "<br /><br /> Importação executada em $tempo segundos";
	
break;



	/////////// Meios de Expressão
	case "meios":
	$antes = strtotime(date('Y-m-d H:i:s')); // note que usei hífen
	echo "<h1>Importando os termos adotados para Meios de expressão...</h1><br />";
	$hoje = date('Y-m-d H:i:s');
	$sql = "SELECT DISTINCT Adotar FROM temp_meio $teste";
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		$gravadora = addslashes($x['Adotar']);
		$sql_update = "INSERT INTO `acervo_termo` (`termo`, `adotado`, `tipo`, `categoria`, `pesquisa`, `id_usuario`, `data_update`, `publicado`) 
		VALUES ('$gravadora', '', '13', '', 'Base antiga', '1', '$hoje', '1')";
		$query_update = mysqli_query($con,$sql_update);
		if($query_update){
			echo "Meio de expressão $gravadora inserida. (1) <br />";	
		}else{
			echo "Erro ao importar $gravadora (2) <br />";
			
		}
	}
	
	echo "<h1>Importando os demais termos...</h1>";
	
	$hoje = date('Y-m-d H:i:s');
	$sql = "SELECT DISTINCT Termo FROM `temp_meio` $teste";
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		$gravadora = addslashes($x['Termo']);
		$sql_busca = "SELECT * FROM acervo_termo WHERE termo LIKE '$gravadora' AND tipo = '13'";
		$query_busca = mysqli_query($con,$sql_busca);
		$num_busca = mysqli_num_rows($query_busca);

		if($num_busca == 0){
			$sql_update = "INSERT INTO `acervo_termo` (`termo`, `adotado`, `tipo`, `categoria`, `pesquisa`, `id_usuario`, `data_update`, `publicado`) 
			VALUES ('$gravadora', '', '13', '', 'Base antiga', '1', '$hoje', '1')";
			$query_update = mysqli_query($con,$sql_update);
			if($query_update){
				echo "Meio de Expressão $gravadora inserido. (3) <br />";	
			}else{
				echo "Erro ao importar $gravadora (4) <br /> ";
			}
	
		}
	}
	echo "<h1>Atualizando os termos preteridos</h1>";
	$hoje = date('Y-m-d H:i:s');
	$sql = "SELECT * FROM temp_meio $teste";
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		$termo = $x['Termo'];
		$adotar = $x['Adotar'];
		if($termo != $adotar){
			$adotar = addslashes($x['Adotar']);
			$sql_busca = "SELECT id_termo FROM acervo_termo WHERE termo LIKE '$adotar' AND tipo ='13'";
			$query_busca = mysqli_query($con,$sql_busca);
			$y = mysqli_fetch_array($query_busca);
			$id = $y['id_termo'];
			$sql_atualiza = "UPDATE acervo_termo SET adotado = '$id' WHERE termo LIKE '$termo'";
			$query_atualiza = mysqli_query($con,$sql_atualiza);
			if($query_atualiza){
				echo "Meio de expressão $termo adota o termo $adotar(5)<br />";	
			}else{
				echo "Erro ao atualizar o termo $termo / $adotar(6)<br />";	
			}
		}	
		
	}
	$depois = strtotime(date('Y-m-d H:i:s'));
	$tempo = $depois - $antes;
	echo "<br /><br /> Importação executada em $tempo segundos";
	
	break;

	/////////// Autoridades
	case "autoridades":
	$antes = strtotime(date('Y-m-d H:i:s')); // note que usei hífen
	echo "<h1>Importando os termos adotados para Autoridades...</h1><br />";
	$hoje = date('Y-m-d H:i:s');
	$sql = "SELECT DISTINCT Adotar FROM acervo_autoridades $teste";
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		$gravadora = addslashes($x['Adotar']);
		$sql_update = "INSERT INTO `acervo_termo` (`termo`, `adotado`, `tipo`, `categoria`, `pesquisa`, `id_usuario`, `data_update`, `publicado`) 
		VALUES ('$gravadora', '', '1', '', 'Base antiga', '1', '$hoje', '1')";
		$query_update = mysqli_query($con,$sql_update);
		if($query_update){
			echo "Autoridade $gravadora inserida. (1) <br />";	
		}else{
			echo "Erro ao importar $gravadora (2) <br />";
			
		}
	}
	
	echo "<h1>Importando os demais termos...</h1>";
	
	$hoje = date('Y-m-d H:i:s');
	$sql = "SELECT DISTINCT Termo FROM `acervo_autoridades` $teste";
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		$gravadora = addslashes($x['Termo']);
		$sql_busca = "SELECT * FROM acervo_termo WHERE termo LIKE '$gravadora' AND tipo = '1'";
		$query_busca = mysqli_query($con,$sql_busca);
		$num_busca = mysqli_num_rows($query_busca);

		if($num_busca == 0){
			$sql_update = "INSERT INTO `acervo_termo` (`termo`, `adotado`, `tipo`, `categoria`, `pesquisa`, `id_usuario`, `data_update`, `publicado`) 
			VALUES ('$gravadora', '', '1', '', 'Base antiga', '1', '$hoje', '1')";
			$query_update = mysqli_query($con,$sql_update);
			if($query_update){
				echo "Autoridade $gravadora inserido. (3) <br />";	
			}else{
				echo "Erro ao importar $gravadora (4) <br /> ";
			}
	
		}
	}
	echo "<h1>Atualizando os termos preteridos</h1>";
	$hoje = date('Y-m-d H:i:s');
	$sql = "SELECT Termo,Adotar FROM acervo_autoridades $teste";
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		$termo = $x['Termo'];
		$adotar = $x['Adotar'];
		if($termo != $adotar){
			$adotar = addslashes($x['Adotar']);
			$sql_busca = "SELECT id_termo FROM acervo_termo WHERE termo LIKE '$adotar' AND tipo ='1'";
			$query_busca = mysqli_query($con,$sql_busca);
			$y = mysqli_fetch_array($query_busca);
			$id = $y['id_termo'];
			$sql_atualiza = "UPDATE acervo_termo SET adotado = '$id' WHERE termo LIKE '$termo'";
			$query_atualiza = mysqli_query($con,$sql_atualiza);
			if($query_atualiza){
				echo "Autoridade $termo adota o termo $adotar(5)<br />";	
			}else{
				echo "Erro ao atualizar o termo $termo / $adotar(6)<br />";	
			}
		}	
		
	}
	$depois = strtotime(date('Y-m-d H:i:s'));
	$tempo = $depois - $antes;
	echo "<br /><br /> Importação executada em $tempo segundos";
	
break;


case "locais":
set_time_limit(0);
echo "Importando Forma Gênero...<br />";
//gravadora
$hoje = date('Y-m-d H:i:s');
$sql = "SELECT DISTINCT Adotar FROM `temp_disco_local`";
$query = mysqli_query($con,$sql);
while($x = mysqli_fetch_array($query)){
	$gravadora = $x['Adotar'];
	$sql_update = "INSERT INTO `acervo_termo` (`termo`, `adotado`, `tipo`, `categoria`, `pesquisa`, `id_usuario`, `data_update`, `publicado`) 
	VALUES ('$gravadora', '', '14', '', 'Base antiga', '1', '$hoje', '1')";
	$query_update = mysqli_query($con,$sql_update);
	if($query_update){
		echo "Forma Gênero $gravadora inserido. <br />";	
	}else{
		echo "Erro ao importar<br />";
		
	}
}
break;

case "locaispreteridos":
set_time_limit(0);

$sql = "SELECT * FROM temp_disco_local";
$query = mysqli_query($con,$sql);
while($x = mysqli_fetch_array($query)){
	$preterido = $x['Termo'];
	$adotar = $x['Adotar'];
	$id = $x['idLocal'];
	if($preterido != $adotar){
		$recupera = "SELECT id_termo FROM acervo_termo WHERE tipo = '14' AND termo LIKE '$adotar' LIMIT 0,1";
		$query_recupera = mysqli_query($con,$recupera);
		$num = mysqli_num_rows($query_recupera);
		if($num > 0){
			$pret = mysqli_fetch_array($query_recupera);
			$idpreterido = $pret['id_termo'];
			$sql_update = "UPDATE `acervo_termo` SET adotado = '$idpreterido' WHERE termo = '$preterido'";
			$query_update = mysqli_query($con,$sql_update);
			if($query_update){
				echo "Termo $preterido atualizado. <br />";	
			}else{
				echo "Erro ao atualizar o termo $preterido<br />";
				
			}
		}
	}
}

break;

case "tabelatipo":
set_time_limit(0);
echo "Importando Forma Gênero...<br />";
//gravadora
	$sql_update = "INSERT INTO `acervo_tipo` (`tipo`, `descricao`, `abreviatura`) SELECT tipo, descricao, abreviatura FROM disco_tipo";
	$query_update = mysqli_query($con,$sql_update);
	if($query_update){
		echo "Tipos inseridos. <br />";	
	}else{
		echo "Erro ao importar<br />";
		
	}

break;



case "categorias": //Estudar...
set_time_limit(0);
echo "Importando Categorias...<br />";

function parenteses($string){

$vowels = array("(", ")");
$onlyconsonants = str_replace($vowels, "", $string);
return $onlyconsonants;	
}

$hoje = date('Y-m-d H:i:s');
$sql = "SELECT DISTINCT Adotar FROM `temp_categorias`";
$query = mysqli_query($con,$sql);
while($x = mysqli_fetch_array($query)){
	$gravadora = parenteses($x['Adotar']);
	$sql_update = "INSERT INTO `acervo_termo` (`termo`, `adotado`, `tipo`, `categoria`, `pesquisa`, `id_usuario`, `data_update`, `publicado`) 
	VALUES ('$gravadora', '', '78', '', 'Base antiga', '1', '$hoje', '1')";
	$query_update = mysqli_query($con,$sql_update);
	if($query_update){
		echo "Forma Gênero $gravadora inserido. <br />";	
	}else{
		echo "Erro ao importar<br />";
		
	}
}
break;

case "categoriaspreteridos": //Estudar...
set_time_limit(0);
echo "Importando Categorias...<br />";
//gravadora
$hoje = date('Y-m-d H:i:s');
$sql = "SELECT DISTINCT Termo FROM `temp_categorias`";
$query = mysqli_query($con,$sql);
while($x = mysqli_fetch_array($query)){
	$gravadora = $x['Termo'];
	$sql_busca = "SELECT * FROM acervo_termo WHERE termo LIKE '$gravadora' AND categoria = '78' LIMIT 0,1";
	$query_busca = mysqli_query($con,$sql_busca);
	$num_busca = mysqli_num_rows($query_busca);
	if($num_busca > 0){
		$adotar = mysqli_fetch_array($query_busca);
		$idAdotar = $adotar['id_termo']; 
		$sql_update = "INSERT INTO `acervo_termo` (`termo`, `adotado`, `tipo`, `categoria`, `pesquisa`, `id_usuario`, `data_update`, `publicado`) 
		VALUES ('$gravadora', '$idAdotar', '78', '', 'Base antiga', '1', '$hoje', '1')";
		$query_update = mysqli_query($con,$sql_update);
		if($query_update){
			echo "Catogria $gravadora inserido. 1<br />";	
		}else{
			echo "Erro ao importar<br /> 2";
		}

	}else{
		$sql_update = "INSERT INTO `acervo_termo` (`termo`, `adotado`, `tipo`, `categoria`, `pesquisa`, `id_usuario`, `data_update`, `publicado`) 
		VALUES ('$gravadora', '', '78', '', 'Base antiga', '1', '$hoje', '1')";
		$query_update = mysqli_query($con,$sql_update);
		if($query_update){
			echo "Forma Gênero $gravadora inserido. 3 <br />";	
		}else{
			echo "Erro ao importar<br /> 4";
		}
	}
}
break;

case "datas": //estudar
set_time_limit(0);
$sql_datas = "SELECT idDisco, data_catalogacao FROM acervo_discoteca WHERE data_catalogacao IS NOT NULL";
$query_datas = mysqli_query($con,$sql_datas);
while($datas = mysqli_fetch_array($query_datas)){
	if($datas['data_catalogacao'] != NULL){
		$id = $datas['idDisco'];
		$data_nova = exibirDataMysql($datas['data_catalogacao']);
		$sql_atualiza = "UPDATE acervo_discoteca SET data_catalogacao = '$data_nova' WHERe idDisco = '$id'";
		$query_atualiza = mysqli_query($con,$sql_atualiza);
		if($query_atualiza){
			echo "Registro $id atualizado.<br />";
		}else{
			echo "Erro ao atualizar registro $id";
			
		}
		
		
	}	
	
}

break;

case "faixas":
set_time_limit(0);
$sql_faixas = "SELECT idDisco, Faixas FROM acervo_discoteca WHERE Faixas IS NOT NULL";
$query_faixas = mysqli_query($con,$sql_faixas);
while($faixas = mysqli_fetch_array($query_faixas)){
	$id = $faixas['idDisco'];
	$faixa_nova = soNumero($faixas['Faixas']);
	$sql_atualiza = "UPDATE acervo_discoteca SET Faixas = '$faixa_nova' WHERE idDisco = '$id'";
	$query_atualiza = mysqli_query($con,$sql_atualiza);
	if($query_atualiza){
		echo "Registro $id atualizado.<br />";
	}else{
		echo "Erro ao atualizar registro $id<br />";
	}

}

break;





case "inicio":
?>
<h1>Geração do Index Invertido das Bases</h1>

<a href="?action=biblioteca">Biblioteca</a><br />
<a href="?action=artes">Artes</a><br />
<a href="?action=museu">Museu</a><br />

<br />

<?php 
break;

} ?>
