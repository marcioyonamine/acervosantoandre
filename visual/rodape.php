

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
                <p><?php geraFrase(); ?></p>
					<p>2017@ Acervos SCSA / Secretaria de Cultura / Santo André</p>
				</div>
				<div class="col-md-12">
					<?php
if($_SESSION['perfil'] == 1){ //mostra as variáveis do sistema para o desenvolvedor
	var_sistema();
}

if(isset($con)){ //garantir o fechamento do socket
	mysqli_close($con);	
}
?>
				</div>
			</div>		
		</div>	
	</footer>
	 
	 <!-- js -->
    <!--<script src="js/jquery.js"></script>-->
    
    <?php 
	if(isset($_GET['perfil'])){
	$modulo = recuperaDados("ig_modulo",$_GET['perfil'],"pag");
	
	?>
    	<script>
	var enter = new Date();
	
	$(document).ready(function() {
		var load = (new Date()).getTime() - enter.getTime();
		$('#doc').text('- Você está no Módulo <?php echo $modulo['nome'] ?>');
	});
	
	<?php } ?>

	</script>
    
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.smooth-scroll.min.js"></script>
	<script src="js/jquery.dlmenu.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/custom.js"></script>
  	</body>
