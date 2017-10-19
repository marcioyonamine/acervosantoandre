<?php

if(isset($_GET['evento'])){
	$idEvento = $_GET['evento'];	
}

if(isset($_GET['registro'])){
	
}

?>

	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h3>Teste</h3>
					<?php
					$coluna = "ip";
					$tabela = "igsis_time";
					var_dump(existeColuna($tabela,$coluna));	
				

					?>



					</div>
				  </div>
			  </div>
			  
		</div>
	</section>