<?php
$con = bancoMysqli();
include 'includes/menuSonoro.php';
if(isset($_POST['cadastraRegistro'])){
	$x = manipulaDados("acervo_artes",$_POST);
	
}

?>


	  <section id="contact" class="home-section bg-white">
	  	<div class="container">
			  <div class="form-group">
					<h3>Obra de Arte</h3>
                    <p><?php var_dump($x);?></p>
                    <br />
                    <br />
               </div>

	  		<div class="row">
	  			<div class="col-md-offset-1 col-md-10">

				<form class="form-horizontal" role="form" action="?perfil=artes&p=sc_insere_obra" method="post">
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Coleção</strong><br/>
                	  <select class="form-control" id="tipoDocumento" name="colecao" >
					   <?php
						 geraAcervoOpcao(2);
						?>
					  </select>
                      </div>
				  </div>	
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Título:</strong><br/>
					  <input type="text" class="form-control" id="Nome" name="titulo"  value="" >
					</div>
				  </div>

                 <!--
				  <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Tipo Geral:</strong><br/>
					  <select class="form-control" id="planilha" name="geral" >
					   <?php
						geraTipoOpcao("geral");
						?>  
					  </select>

					</div>				  
					<div class=" col-md-6"><strong>Tipo Específico:</strong><br/>
                	  <select class="form-control" id="geral" name="especifico" >
					   <?php
						geraTipoOpcao("especifico");
						?>  
					  </select>
					</div>
				  </div>-->
				   <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Salão:</strong><br/>
					  <input type="text" class="form-control soNumero" id="salao" name="salao"  value="" >

					</div>				  
					<div class=" col-md-6"><strong>Ano de Aquisição:</strong><br/>
					  <input type="text" class="form-control ano" id="ano_aq" name="ano_aq"  value="" >

					</div>	
				  </div>
		   <div class="form-group">
           				<div class="col-md-offset-2 col-md-6"><strong>Ano de Assinatura:</strong><br/>
					  <input type="text" class="form-control ano" id="ano_as" name="ano_as"  value="" >
					</div>
					<div class=" col-md-6"><strong>Patrimônio:</strong><br/>
					  <input type="text" class="form-control soNumero" id="ano_aq" name="patrimonio"  value="" >

					</div>				  
					
		  </div>                  
		   <div class="form-group">
           				<div class="col-md-offset-2 col-md-6"><strong>Número de Processo:</strong><br/>
					  <input type="text" class="form-control soNumero" id="ano_as" name="processo"  value="" >
					</div>
					<div class=" col-md-6"><strong>Altura (CM):</strong><br/>
					  <input type="text" class="form-control soNumero" id="ano_aq" name="altura"  value="" >

					</div>				  
					
		  </div>                  
		   <div class="form-group">
           				<div class="col-md-offset-2 col-md-6"><strong>Largura (CM):</strong><br/>
					  <input type="text" class="form-control soNumero" id="ano_as" name="largura"  value="" >
					</div>
					<div class=" col-md-6"><strong>Profundidade (CM):</strong><br/>
					  <input type="text" class="form-control soNumero" id="ano_aq" name="profundidade"  value="" >

					</div>				  
					
		  </div>                  
		   <div class="form-group">
					<div class="col-md-offset-2 col-md-6"><strong>Moeda:</strong><br/>
                	  <select class="form-control" id="geral" name="moeda" >
					   <?php
						geraTipoOpcao("moeda");
						?>  
					  </select>
					</div>
					<div class=" col-md-6"><strong>Valor:</strong><br/>
					  <input type="text" class="form-control valor" id="valor" name="valor"  value="" >

					</div>				  
					
		  </div>   
                            <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Localização *:</strong><br/>
					  <input type="text" class="form-control" id="Nome" name="localizacao"  value="" >
					</div>
				  </div>               


			 
                  
                  <div class="form-group">
					<div class="col-md-offset-2 col-md-8"><strong>Observações:</strong><br/>
					 <textarea name="obs" class="form-control" rows="10" placeholder=""></textarea>
					</div>
				  </div>

				  <div class="form-group">
					<div class="col-md-offset-2 col-md-8">
                    <input type="hidden" name="cadastraRegistro" value="1" />
 					 <input type="submit" value="GRAVAR" class="btn btn-theme btn-lg btn-block">
					</div>
				  </div>
				</form>
				  
                

    
	  			</div>
			
				
	  		</div>
			

	  	</div>
	  </section>  
