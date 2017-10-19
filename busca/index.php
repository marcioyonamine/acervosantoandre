<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Acervos Culturais Santo André - v0.1 - 2017</title>
    <link href="visual/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="visual/css/style.css" rel="stylesheet" media="screen">
	<link href="visual/color/default.css" rel="stylesheet" media="screen">
	<script src="visual/js/modernizr.custom.js"></script>
</head>


<body>
<?php 

/*
SCPSA v0.1 - 2017

titulo nome.titulo_titulo.conteudo_conteudo
autor
descricao descricao.dados_procedencia.circula_referencia.producao_local.producao_funcaoOriginal.conteudo_descricao.descricao_array.classificao_nome


Localização: localizacao localizao_padrao
Procedência: procedencia
Local: producao_local




*/

// Esta é a página de login do usuário ou de contato com administrador do sistema.

//Imprime erros com o banco
   @ini_set('display_errors', '1');
	error_reporting(E_ALL); 

include "../funcoes/funcoesGerais.php";
include "../funcoes/funcoesConecta.php";



if(isset($_GET['pesquisa'])){
	$con = bancoMysqli();
	$pesquisa = $_GET['pesquisa'];
	switch($_GET['acervo']){
		
		case 1:
		$acervo = " AND acervo = '1' ";
		
		break;	

		case 2:
		$acervo = " AND acervo = '2' ";
		
		break;	

		case 3:
		$acervo = " AND acervo = '3' ";
		
		break;	

		case 4:
		$acervo = " AND acervo = '4' ";
		
		break;	


		default;
		$acervo = "";
		
		break;	
	
		
	}	
	
	// roda a tabela registro pela palavra
	
	//$sql_busca_registro = "SELECT DISTINCT id_registro FROM acervo_registro WHERE titulo LIKE '%$pesquisa%' OR id_registro IN (SELECT DISTINCT idReg FROM acervo_relacao_termo, acervo_termo WHERE acervo_termo.termo LIKE '%$pesquisa%' AND acervo_relacao_termo.idTermo = acervo_termo.id_termo)";
	
	//$sql_busca_registro = "SELECT DISTINCT id_registro FROM acervo_registro WHERE titulo LIKE '%$pesquisa%'";
	
//	$sql_busca_registro = "SELECT DISTINCT id_registro FROM acervo_registro,acervo_relacao_termo  WHERE acervo_relacao_termo.idReg = acervo_registro.id_registro AND (acervo_registro.titulo LIKE '%$pesquisa%' OR acervo_registro.id_registro IN (SELECT DISTINCT idRel FROM acervo_termo WHERE termo LIKE '%$pesquisa%' AND publicado = '1')) AND acervo_registro.publicado = '1' ";
	
	$sql_busca_registro = "SELECT * FROM acervo_index WHERE comum LIKE '%$pesquisa%' $acervo";

	/*SELECT tabela1.campos, tabela2.campos 
FROM tabela1 
INNER JOIN tabela2 ON (tabela1.id=tabela2.id_tabela1) 
INNER JOIN tabela3 ON (tabela2.id=tabela3.id_tabela2) // pode ser tabela1 ao invés de tabela2 
WHERE tabela1.campo=valor 
*/
	
	
	$qStart = microtime(true);
	$query_registro = mysqli_query($con,$sql_busca_registro);
	$qEnd = microtime(true);
	$tempo = $qEnd-$qStart;
	
	//paginacao
	$num01 = mysqli_num_rows($query_registro);
	$total_pagina = 50;	
	if(isset($_GET['n_pag'])){
		$pc = $_GET['n_pag'];	
	}else{
		$pc = "1";	
	}
	$inicio = $pc - 1;
	$inicio = $inicio*$total_pagina;
	$limite = mysqli_query($con,"$sql_busca_registro $acervo LIMIT $inicio,$total_pagina ");
	$total = $num01;
	
	$tp = $total/$total_pagina;
	 
	$mensagem = "Foram encontrados $num01 registros para '$pesquisa' em $tempo s. <br />";
	
	

	 
 
?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h3>Acervos Culturais de Santo André</h3>
                    

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            <h5><?php if(isset($mensagem)){ echo $mensagem; } ?></h5>
            <h5><?php //echo $sql_busca_registro; ?></h5>
                         

            	</div>
             </div>
				<br />             
				<?php 
				while($res = mysqli_fetch_array($limite)){
				
				?>	
	            <div class="form-group">
		            <div class="col-md-offset-2 col-md-8">
               <div class="left">

				<?php 
				exibeRegistro($res['acervo'],$res['idAcervo']);
				?>						

                			    </div>
				</div>		            
        	    </div>
        	    <?php 
        	    } ?>
								
<div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	           <br /><br />            
            </div>
          </div>   				<div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <?php 
				$anterior = $pc - 1;
				$proximo = $pc + 1;
				if($pc > 1){
					echo "<a href='?pesquisa=$pesquisa&acervo=".$_GET['acervo']."&n_pagina=$anterior'><- Anterior</a>";
				}
				echo " | ";
				if($pc < $tp) {
 				 echo " <a href='?pesquisa=$pesquisa&acervo=".$_GET['acervo']."&n_pag=$proximo'>Próxima -></a>";
 				 }
				?>            
            </div>
          </div>      

				<div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	            <a href="?" class="btn btn-theme btn-lg btn-block">Fazer outra busca</a>                
            </div>
          </div>           	    </div>

            </div>
	</section>





<?php }else{ // caso não tenha enviado dados para pesquisa ?>



	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Acervos Culturais de Santo André</h2>
                     <p>Os campos em que ocorrerá a busca são: título, autor, assunto</p>
                     <p>É possível pesquisar por parte da palavra. Deve-se ter pelo menos 3 caracteres para busca.</p>
                    

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            <h5><?php if(isset($mensagem)){ echo $mensagem; } ?>
                        <form method="GET" action="?" class="form-horizontal" role="form">
            		<label>Busca por palavras</label>
                    
                    
            		<input type="text" name="pesquisa" class="form-control" id="palavras" placeholder="" ><br />
                    <select name="acervo">
                    <option value="0">Todos os Acervos Culturais</option>
                    <option value="1">Biblioteca</option>
                    <option value="2">Acervo de Artes</option>
                    <option value="3">Museu Base Nova</option>
                    <option value="4">Museu Base Antiga</option>

                    </select>

            	</div>
             </div>
				<br />             
	            <div class="form-group">
		            <div class="col-md-offset-2 col-md-8">

    		        <input type="submit" class="btn btn-theme btn-lg btn-block" value="Pesquisar">
                    </form>
        	    	</div>
        	    </div>

            </div>
	</section>

<?php } 

?>


</body>
</html>
