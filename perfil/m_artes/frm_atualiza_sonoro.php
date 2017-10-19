<?php
$con = bancoMysqli();
include 'includes/menuSonoro.php';

if(isset($_POST['cadastraRegistro']) OR isset($_POST['atualizaRegistro'])){
	
  	$colecao = $_POST["colecao"];
    $salao = $_POST["salao"];
    $ano_aq = $_POST["ano_aq"];
    $ano_as = $_POST["ano_as"];
    $patrimonio = $_POST["patrimonio"];
    $processo = $_POST["processo"];
    $altura = $_POST["altura"];
    $largura = $_POST["largura"];
    $profundidade = $_POST["profundidade"];
    $moeda = $_POST["moeda"];
    $valor = $_POST["valor"];
    $localizacao = $_POST["localizacao"];
    $id = $_POST["cadastraRegistro"];
	$hoje = date("Y-m-d H:i:s");
	$titulo = addslashes($_POST['titulo']);
	$obs = addslashes($_POST['obs']);
	$publicado = 1;
	$catalogador = $_SESSION['idUsuario'];
	$colecao_acervo = 2;
}

if(isset($_POST['cadastraRegistro'])){
	$sql_insere = "INSERT INTO `acervo_artes` (`id`, `salao`, `ano_aquisicao`, `ano_assinatura`, `localizacao`, `patrimonio`, `pa_aquisicao`, `titulo`, `altura`, `largura`, `profundidade`, `moeda`, `valor`, `obs`, `idAntigo`) VALUES (NULL, '$salao', '$ano_aq', '$ano_as', '$localizacao','$patrimonio', '$processo', '$titulo', '$altura', '$largura', '$profundidade', '$moeda', '$valor', '$obs',  '');";
	$query_insere = mysqli_query($con,$sql_insere);
	if($query_insere){
		$ultimo = mysqli_insert_id($con);
		$sql_insert_registro = "INSERT INTO `acervo`.`acervo_registro` (`id_registro`, `titulo`, `id_autoridade`, `id_acervo`, `id_tabela`, `publicado`, `tabela`, `data_catalogacao`, `idUsuario`) 
		VALUES (NULL, '$titulo', '', '$colecao_acervo', '$ultimo', '1','126','$hoje','$catalogador')";
		$query_insert_registro = mysqli_query($con,$sql_insert_registro);
		
		if($query_insert_registro){
			$mensagem = "Inserido com sucesso(1)";
		}else{
			$mensagem = "Erro ao inserir(2)";	
		}
	}else{
		$mensagem = "Erro ao inserir(3)";	
	}
$_SESSION['idDisco'] = $ultimo;
}

if(isset($_POST['atualizaRegistro'])){
	$ultimo = $_SESSION['idDisco'];
	$sql_atualiza = "UPDATE `acervo_artes` SET
	`salao`=    $salao,
	ano_aquisicao`= $ano_aq,
	`ano_assinatura`= $ano_as,
	`localizacao`= $ localizacao ,
	`patrimonio`= $patrimonio,
	`pa_aquisicao`= $processo,
	`titulo`= $titulo,
	`altura`= $altura ,
	`largura`= $largura,
	`profundidade`= $profundidade ,
	`moeda`= $moeda ,
	`valor`= $valor ,
	`obs`= $obs
	    
	
	WHERE id = '$id';";
	
	
     
	$query_atualiza = mysqli_query($con,$sql_atualiza);
	if($query_atualiza){
		$sql_update_registro = "UPDATE `acervo_registro` SET
		`id_acervo` = '$colecao',
		`titulo` = '$titulo',
		`idUsuario` = '$catalogador', 
		`data_catalogacao` = '$hoje'
		WHERE id_tabela = '$ultimo' AND tabela = '87'";
		$query_update_registro = mysqli_query($con,$sql_update_registro);
		if($query_update_registro){
			$mensagem = "Atualizado com sucesso(1)";
		}else{
			$mensagem = "Erro ao atualizar(2)";	
		}
	}else{
		$mensagem = "Erro ao atualizar(3)";	
	}
}

if(!isset($ultimo)){
	if(isset($_POST['idDisco'])){
		$ultimo = $_POST['idDisco'];
		$_SESSION['idDisco'] = $ultimo;
		
	}else{
		$ultimo = $_SESSION['idDisco'];	
	}
}
$disco = recuperaDados("acervo_discoteca",$ultimo,"idDisco");
$registro = recuperaDados("acervo_registro",$ultimo,"id_tabela");



$_SESSION['idReg'] = $registro['id_registro'];
$_SESSION['idDisco'] = $disco['idDisco'];
$_SESSION['idAnalitica'] = 0;

// Define as sessions



?>

	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<h4>REGISTRO SONORO - MATRIZ</h4>
					<h3><?php echo $registro['titulo'];?></h3>

                    <p><?php if(isset($mensagem)){ echo $mensagem; } ?></p>
                    <br />
                    <br />
               </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=discoteca&p=frm_atualiza_sonoro" method="post">
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Coleção</strong><br/>
                	  <select class="form-control" id="tipoDocumento" name="colecao" >
					   <?php
						 geraAcervoOpcao(6,$registro['id_acervo']);
						?>
					  </select>
                      </div>
				  </div>	
                                    <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Tombo / Localização</strong><br/>
					  <input type="text" class="form-control " id="" name="tombo"  value="<?php echo $disco['tombo']; ?>" >
                      </div>
				  </div>	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Tipo Geral:</strong><br/>
					  <select class="form-control" id="planilha" name="geral" >
					   <?php
						geraTipoOpcao("geral",$disco['tipo_geral']);
						?>  
					  </select>

					</div>				  
					<div class=" col-md-6"><strong>Tipo Específico:</strong><br/>
                	  <select class="form-control" id="geral" name="especifico" >
					   <?php
						geraTipoOpcao("especifico",$disco['tipo_especifico']);
						?>  
					  </select>
					</div>
				  </div>
				   <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Número de Faixas:</strong><br/>
					  <input type="text" class="form-control soNumero" id="duracao" name="faixas"  value="<?php echo $disco['faixas']; ?>" >

					</div>				  
					<div class=" col-md-6"><strong>Exemplares:</strong><br/>
					  <input type="text" class="form-control soNumero" id="duracao" name="exemplares"  value="<?php echo $disco['exemplares']; ?>" >
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><br/>
					<h5>Imprenta</h5>
                      </div>
				  </div>
			 
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Gravadora</strong><br/>
                	  <select class="form-control" id="tipoDocumento" name="gravadora" >

					   <?php
						opcaoTermo(12,$disco['gravadora']);
						?>  
					  </select>
                      </div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Registro / Número de Chapa / Copyright:</strong><br/>
					  <input type="text" class="form-control" id="Nome" name="registro"  value="<?php echo $disco['registro']; ?>" >
					</div>
				  </div>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Tipo de data:</strong><br/>
                    <select class="form-control" id="tipoDocumento" name="tipo_data" >
					   <?php
						geraTipoOpcao("data",$disco['tipo_data']);
						?> 
                        </select> 
					</div>				  
					<div class=" col-md-6"><strong>Data da gravação:</strong><br/>
					  <input type="text" class="form-control" id="CCM" name="data_gravacao"  value="<?php echo $disco['data_gravacao']; ?>" >
					</div>
				  </div>


                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Local da gravação:</strong><br/>
					                	  <select class="form-control" id="tipoDocumento" name="local" >
					   <option>Selecione o local da gravação</option>

					  <?php
						opcaoTermo(14,$disco['local_gravacao']);;
						?>  
					  </select>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><br/>
					<h5>Descrição Física</h5>
                      </div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Tipo:</strong><br/>
					                	  <select class="form-control" id="tipoDocumento" name="fisico" >
					   <?php
						geraTipoOpcao("fisico", $disco['descricao_fisica']);
						?>  
					  </select>
					</div>
				  </div>
				  
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Estereo/Mono:</strong><br/>
					                	  <select class="form-control" id="tipoDocumento" name="estereo" >
					   <?php
						geraTipoOpcao("estereo", $disco['estereo']);
						?>  
					  </select>					</div>				  
					<div class=" col-md-6"><strong>Polegadas:</strong><br/>
					                	  <select class="form-control" id="tipoDocumento" name="polegadas" >
					   <?php
						geraTipoOpcao("polegadas",$disco['polegadas']);
						?>  
					  </select>					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><br/>
					<h5>Título</h5>
                      </div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Título *:</strong><br/>
					  <input type="text" class="form-control" id="Nome" name="titulo"  value="<?php echo $disco['titulo_disco']; ?>" >
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Título Uniforme *:</strong><br/>
					  <input type="text" class="form-control" id="Nome" name="titulo_uniforme" value="<?php echo $disco['titulo_uniforme']; ?>" >
					</div>
				  </div>


				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Conteúdo:</strong><br/>
					 <textarea name="conteudo" class="form-control" rows="10" placeholder=""><?php echo $disco['conteudo']; ?></textarea>
					</div>
				  </div>
                                    <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Notas:</strong><br/>
					 <textarea name="notas" class="form-control" rows="10" placeholder=""><?php echo $disco['notas']; ?></textarea>
					</div>
				  </div>
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observações:</strong><br/>
					 <textarea name="obs" class="form-control" rows="10" placeholder=""><?php echo $disco['obs']; ?></textarea>
					</div>
				  </div>
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Finalizado:</strong><br/>
		        <input type="checkbox" class ="checkbox-circle" name="fim" <?php checar($disco['fim']) ?> >
                	
                  </div>
					</div>

				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <input type="hidden" name="atualizaRegistro" value="1" />
 					 <input type="submit" value="atualizar" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
				</form>

				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
 <a href="?perfil=discoteca&p=frm_termos" class="btn btn-theme btn-block"  >Autoridades / Assuntos</a>
					</div>
				  </div>	
                  				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <br />
					</div>
				  </div>	 
   				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
 <a href="?perfil=discoteca&p=frm_arquivos" class="btn btn-theme btn-block"  >Arquivos / Anexos</a>
					</div>
				  </div>	
                  				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <br />
					</div>
				  </div>	                

<?php if($disco['faixas'] > 1){ ?>
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
<a href="?perfil=discoteca&p=frm_analiticas_sonoro" class="btn btn-theme btn-block" >Faixas (Analítica)</a>
					</div>
				  </div>				  
<?php } ?>


    
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

