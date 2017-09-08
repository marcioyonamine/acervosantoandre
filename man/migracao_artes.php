<?php
//Exibe erros PHP
@ini_set('display_errors', '1');
error_reporting(E_ALL); 
require "../funcoes/funcoesConecta.php";
require "../funcoes/funcoesGerais.php";

$con = bancoMysqli();
set_time_limit(0);
//$teste = " LIMIT 0,1000";
$teste = "";

	function retornaLinguagem($string){
		$con = bancoMysqli();
		$sql = "SELECT tipo2 FROM temp_linguagem WHERE tipo1 = '$string'";
		$query = mysqli_query($con,$sql);
		$x = mysqli_fetch_array($query);
		return $x['tipo2'];
	
	}



if(isset($_GET['action'])){
	$action = $_GET['action'];
}else{
	$action = "inicio";
}


switch($action){

	/////////// Autoridades
	case "dimensao":
	$antes = strtotime(date('Y-m-d H:i:s')); // note que usei hífen
	echo "<h1>Calculando as dimensões...</h1><br />";
	$hoje = date('Y-m-d H:i:s');
	//$sql = "SELECT id, planilha, tipo_geral, tombo_antigo, editora, n_chapa, fisica, paginas, medida, titulo_partitura, titulo_uniforme, titulo_analitica, conteudo, resumo_titulo, resumo_notas, obs FROM temp_partituras $teste";
	$sql_busca = "SELECT id, dimensao FROM temp_artes ";
	$query_busca = mysqli_query($con,$sql_busca);
	while($x = mysqli_fetch_array($query_busca)){
		$dimensao = dimensao($x['dimensao']);
		$sql_update = "UPDATE acervo_artes SET 
		altura = '".$dimensao['altura']."',
		largura = '".$dimensao['largura']."',
		profundidade = '".$dimensao['profundidade']."'
		WHERE idAntigo = '".$x['id']."'";
		$query_update = mysqli_query($con,$sql_update);
		if($query_update){
			echo $x['id']." atualizado!<br />";	
		}else{
			echo "Erro ao atualizar ".$x['id']." <br />";	
		}
		
	}
	
	
	
	$depois = strtotime(date('Y-m-d H:i:s'));
	$tempo = $depois - $antes;
	echo "<br /><br /> Importação executada em $tempo segundos";
	
break;





	/////////// Autoridades
	case "ids":
	$antes = strtotime(date('Y-m-d H:i:s')); // note que usei hífen
	echo "<h1>Criando as IDs...</h1><br />";
	$hoje = date('Y-m-d H:i:s');
	$sql = "SELECT * FROM temp_artes $teste";
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		$id = $x['id'];
		$salao = $x['salao'];
		$ano_aq = $x['ano_aquisicao']."-00-00";
		$ano_as = $x['ano_obra']."-00-00";
		$localizacao = $x['localizacao'];
		$patrimonio = $x['patrimonio'];
		$processo = $x['processo'];
		$titulo = $x['titulo'];
		$obs = $x['obs'];
		
		if(verificaExiste("acervo_artes","idAntigo",$id) == FALSE){
		
			$sql_update = "INSERT INTO `acervo_artes` (`salao`, `ano_aquisicao`, `ano_assinatura`, `localizacao`, `patrimonio`, `pa_aquisicao`, `titulo`, `obs`, `idAntigo`) VALUES ('$salao', '$ano_aq', '$ano_as', '$localizacao', '$patrimonio', '$processo', '$titulo', '$obs', '$id') ;";
			echo $sql_update."<br />";
			$query_update = mysqli_query($con,$sql_update);
			if($query_update){
				echo "Registro $id inserido. (1) <br />";	
			}else{
				echo "Erro ao inserir $id (2) <br />";
			}
		}
	}
	break;

	case "registros":
	$antes = strtotime(date('Y-m-d H:i:s')); // note que usei hífen
	echo "<h1>Criando os registros...</h1><br />";
	$hoje = date('Y-m-d H:i:s');
	$sql = "SELECT idDisco, titulo_disco FROM acervo_discoteca $teste";
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		$idDisco = $x['idDisco'];
		$titulo = $x['titulo_disco'];
		$sql_update = "INSERT INTO `acervo`.`acervo_registro` 
		(`titulo`, `id_acervo`, `id_tabela`, `publicado`, `tabela`, `data_catalogacao`, `idUsuario`) 
		VALUES ('$titulo', '7', '$idDisco', '1', '97', '$hoje', '1');";
		$query_update = mysqli_query($con,$sql_update);
		if($query_update){
			echo "Registro $titulo inserido. (1) <br />";	
		}else{
			echo "Erro ao inserir $titulo (2) <br />";
			
		}
	}


	break;

	
	case "relacao_autoridades":
	$antes = strtotime(date('Y-m-d H:i:s')); // note que usei hífen
	echo "<h1>Criando os registros...</h1><br />";
	$hoje = date('Y-m-d H:i:s');
	
	$sql = "SELECT autoridade01, categoria01,
	autoridade02, categoria02,
	autoridade03, categoria03, 
	autoridade04, categoria04, 
	autoridade05, categoria05, 
	autoridade06, categoria06, 
	autoridade07, categoria07, 
	autoridade08, categoria08, 
	autoridade09, categoria09, 
	autoridade10, categoria10,
	idDisco
	FROM temp_acervo_discoteca $teste"; 
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
		for($i = 1; $i <= 10; $i++){
			
			if($i == 10){
				$termo =  addslashes($x['autoridade10']);
				$categoria = retiraParenteses($x['categoria10']);
			}else{
				$termo =  addslashes($x['autoridade0'.$i.'']);
				$categoria = retiraParenteses($x['categoria0'.$i.'']);
			}
			if($termo != "" AND $termo != NULL AND $termo != "."){	
				
				
						
				$idTermo = recuperaIdTermo($termo,1);
				$idCat = recuperaIdTermo($categoria,78);
				$idNovo = recuperaIdTemp($x['idDisco'],87);
				$idReg = idReg($idNovo,87);
				

				if($idTermo == NULL OR $idTermo == 0){
					$sql_insere = "INSERT INTO acervo_termo (termo, tipo, id_usuario, data_update, publicado)
					VALUES ('$termo','1','1','$hoje','1')";	
					$query_insere = mysqli_query($con,$sql_insere);
					if($query_insere){
						$idTermo = mysqli_insert_id($con);
						echo "$termo inserido na base termos<br />";	
					}else{
						echo "Erro ao inserir o $termo<br />";
						}
				}

				$sql_insert = "INSERT INTO `acervo_relacao_termo` (`idRel`, `idReg`, `idTermo`, `idTipo`, `idCat`, `publicado`) 
				VALUES ('', '$idReg', '$idTermo', '1', '$idCat', '1')";
				$query_insert = mysqli_query($con,$sql_insert);
				
				if($query_insert){
					echo "Termo $termo inserido em ID $idReg<br />";
				}else{
					echo "Erro.<br />";	
				}

				//echo var_dump($idTermo)."<br />";
			}

		}
	}
	
	
	$depois = strtotime(date('Y-m-d H:i:s'));
	$tempo = $depois - $antes;
	echo "<br /><br /> Importação executada em $tempo segundos";
	break;	
	
	case "relacao_sem_autoridades":
	$antes = strtotime(date('Y-m-d H:i:s')); // note que usei hífen
	echo "<h1>Criando os registros...</h1><br />";
	$hoje = date('Y-m-d H:i:s');
	
	function verificaNulidade($x){
		return TRUE;
		if($x == NULL OR $x == "" OR $x == "." ){
			return NULL;	
		}
			
	}

	
	$sql = "SELECT autoridade01, categoria01,
	autoridade02, categoria02,
	autoridade03, categoria03, 
	autoridade04, categoria04, 
	autoridade05, categoria05, 
	autoridade06, categoria06, 
	autoridade07, categoria07, 
	autoridade08, categoria08, 
	autoridade09, categoria09, 
	autoridade10, categoria10,
	resumo_autoridades,
	idDisco
	FROM temp_discoteca"; 
	
	$query = mysqli_query($con,$sql);
	while($x = mysqli_fetch_array($query)){
	
		if($x['autoridade01'] == NULL OR trim($x['autoridade01']) == "." OR trim($x['autoridade01']) == "" )
		
		{
			$termo = resumoAutoridades($x['resumo_autoridades']);	
				for($j = 0; $j <= count($termo); $j++){
					$idTermo = recuperaIdTermo($termo[$j]['termo'],1);
					$idCat = recuperaIdTermo($termo[$j]['categoria'],78);
					$idNovo = recuperaIdTemp($x['idDisco'],87);
					$idReg = idReg($idNovo,87);
					
					/*
					if($idTermo == NULL OR $idTermo == 0){
						$sql_insere = "INSERT INTO acervo_termo (termo, tipo, id_usuario, data_update, publicado)
						VALUES ('$termo','1','1','$hoje','1')";	
						$query_insere = mysqli_query($con,$sql_insere);
						if($query_insere){
							$idTermo = mysqli_insert_id($con);
							echo "$termo inserido na base termos<br />";	
						}else{
							echo "Erro ao inserir o $termo<br />";
							}
					}

					$sql_insert = "INSERT INTO `acervo_relacao_termo` (`idRel`, `idReg`, `idTermo`, `idTipo`, `idCat`, `publicado`) 
					VALUES ('', '$idReg', '$idTermo', '1', '$idCat', '1')";
					$query_insert = mysqli_query($con,$sql_insert);
					
					if($query_insert){
						echo "Termo $termo inserido em ID $idReg<br />";
					}else{
						echo "Erro.<br />";	
					}
					*/
					
					echo $idTermo." - ".$idCat." - ".$idReg." <br />";
				}
			echo "Há nulidade<br />";
		}else{
			echo "Não há nulidade<br />";
		}
	}
	
	
	$depois = strtotime(date('Y-m-d H:i:s'));
	$tempo = $depois - $antes;
	echo "<br /><br /> Importação executada em $tempo segundos";
	break;



	case "tecnicas":
	$antes = strtotime(date('Y-m-d H:i:s')); // note que usei hífen
	echo "<h1>Inserindo técnicas ...</h1><br />";
	$hoje = date('Y-m-d H:i:s');
	
	//insere primeiro a coluna tipo2
	$sql_select = "SELECT DISTINCT tipo2 FROM temp_linguagens";
	$query_select = mysqli_query($con,$sql_select);
	while ($x = mysqli_fetch_array($query_select)){
		if(verificaExiste("acervo_termo","termo",$x['tipo2']) == FALSE){
		$termo = $x['tipo2'];
		$sql_insert2 = "INSERT INTO `acervo_termo` (`termo`, `tipo`, `id_usuario`, `data_update`, `publicado`) VALUES 
		('$termo', '127', '1', '$hoje', '1')";
		$query_insert2 = mysqli_query($con,$sql_insert2);
			if($query_insert2){
				echo "Termo $termo inserido com sucesso!<br />";
			}else{
				echo "Erro ao inserir o termo $termo!<br />";
				
			}	
		}
	}

	//insere a coluna tipo1

	$sql_select = "SELECT * FROM temp_linguagens";
	$query_select = mysqli_query($con,$sql_select);
	while ($x = mysqli_fetch_array($query_select)){
		if(verificaExiste("acervo_termo","termo",$x['tipo1']) == FALSE){
		$termo = $x['tipo1'];
		$sql_insert2 = "INSERT INTO `acervo_termo` (`termo`, `tipo`, `id_usuario`, `data_update`, `publicado`) VALUES 
		('$termo', '127', '1', '$hoje', '1')";
		$query_insert2 = mysqli_query($con,$sql_insert2);
			if($query_insert2){
				echo "Termo $termo inserido com sucesso!<br />";
			}else{
				echo "Erro ao inserir o termo $termo!<br />";
				
			}	
		}
	}
	

	

	
	
	$depois = strtotime(date('Y-m-d H:i:s'));
	$tempo = $depois - $antes;
	echo "<br /><br /> Importação executada em $tempo segundos";
	break;
	
	
	case "autoridades":
	
	//Sistema de controle de tempo
	$antes = strtotime(date('Y-m-d H:i:s')); // note que usei hífen
	echo "<h1>Importando autoridades...</h1><br />";
	$hoje = date('Y-m-d H:i:s');
	$i = 0;	
	$sql_select = "SELECT DISTINCT autor FROM temp_artes";
	$query_select = mysqli_query($con,$sql_select);
	while($x = mysqli_fetch_array($query_select)){
		if(verificaExiste("acervo_termo","termo",addslashes($x['autor'])) == FALSE){
		$autor = addslashes($x['autor']);
		$hoje = date("Y-m-d H:i:s");
		$sql_insert = "INSERT INTO `acervo_termo` (`termo`, `tipo`, `id_usuario`, `data_update`, `publicado`) VALUES ('$autor', '1',  '1', '$hoje', '1');";
		$query_insert =  mysqli_query($con,$sql_insert);
		if($query_insert){
			echo $autor." inserido com sucesso.<br />";	
		}else{
			echo $sql_insert."<br />";
			echo "Erro ao inserir o $autor.<br />";	
			
		}
		}
	}
	

	$depois = strtotime(date('Y-m-d H:i:s'));
	$tempo = $depois - $antes;
	echo "<br /><br /> Importação executada em $tempo segundos";
	
	
	break;

	
	
	case "inicio":
?>
<h1>Importação dos termos para a base</h1>
<!--
<a href="?action=titulos">Migrar titulos</a><br />
<br />
<a href="?action=registros">Criar registros</a><br />
<br />
-->

<a href="?action=ids">Importa id, Titulo, salao, anos, registro, localizacao, e patrimonio e cria nova ID (INSERT)</a><br />
<br />
<a href="?action=dimensao">Atualiza as dimensões da obra (UPDATE)</a><br />
<br />
<a href="?action=autoridades">Atualiza a tabela autoridades (INSERT)</a><br />
<br />
<a href="?action=tecnicas">Insere linguagens e técnicas (INSERT)</a><br />
<br />
<a href="?action=relacao_sem_autoridades">Relações SEM Autoridades (INSERT)</a><br />
<br />
<a href="?action=analitica">Criar relações Matriz / Analítica (UPDATE)</a><br />
<br />

<a href="?action=tombo_update">Atualizao tombo antigo na base nova (UPDATE)</a><br />
<br />

<?php 
break;

} ?>
