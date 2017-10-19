<?php
$con = bancoMysqli();
include 'includes/menuSonoro.php';

$registro = recuperaDados("acervo_registro",$_GET['id'],"id_registro");
$artes = recuperaDados("acervo_artes",$registro['id_tabela'],"id");


// Define as sessions



?>

	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<h4>Resumo</h4>
					<h3><?php echo $registro['titulo'];?></h3>

                    <p><?php if(isset($mensagem)){ echo $mensagem; } ?></p>
                    <br />
                    <br />
               </div>

	  		<div class="row">
                      <div class="form-group">
	  			<div class="col-md-offset-1 col-md-10" style="text-align:left">
			<p>Salão: <?php echo $artes['salao'];?> º</p>
			<p>Artista: <?php $autoridades = retornaAutoridades(idReg($_GET['id'],126),NULL,1); echo $autoridades['string']; ?></p>
            <p> Ano de Aquisição : <?php echo $artes['ano_aquisicao'];?> - Ano de Assinatura: <?php echo $artes['ano_assinatura'];?> </p>	

			<p>Dimensões: <?php echo $artes['altura']." X ".$artes['largura']; if($artes['profundidade'] != 0){echo " X ".$artes['profundidade'];}?></p>
            <p> Processo: <?php echo $artes['patrimonio'];?> - Patrimônio <?php echo $artes['pa_aquisicao'];?> </p>	
            

                      </div>
				  </div>	
           <div class="form-group">
				<h4>Histórico / Ocorrências </h4>
		  </div>	

           <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                      </div>
		  </div>	

           <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                      </div>
		  </div>	


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

				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
<a href="?perfil=discoteca&p=frm_analiticas_sonoro" class="btn btn-theme btn-block" >Faixas (Analítica)</a>
					</div>
				  </div>				  


    
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  

