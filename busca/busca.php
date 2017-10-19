<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CLARA.CCSP - v0.1 - 2016</title>
    <link href="visual/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="visual/css/style.css" rel="stylesheet" media="screen">
	<link href="visual/color/default.css" rel="stylesheet" media="screen">
	<script src="visual/js/modernizr.custom.js"></script>
</head>


<body>
<?php 



include "funcoes/funcoesGerais.php";
function bancoMysqli(){ 
	$servidor = 'localhost';
	$usuario = 'root';
	$senha = '';
	$banco = 'sc_acervos';
	$con = mysqli_connect($servidor,$usuario,$senha,$banco); 
	mysqli_set_charset($con,"utf8");
	return $con;
}

if(isset($_POST['pesquisa'])){
	$con = bancoMysqli();
	$pesquisa = $_POST['pesquisa'];	
	$sql_busca = "SELECT * FROM acervo_index WHERE comum LIKE '%$pesquisa%'";
	 $resultado = mysqli_query($con,$sql_busca);
	 $num = mysqli_num_rows($resultado);
	 if($num == 0){
		$mensagem = "Não foram encontrados resultados";	
	}else{
		$mensagem = "Foram encontrados <strong>$num</strong> resultados para busca por <strong>\"$pesquisa\"</strong>";	
	}
	 
?>
	 <section id="services" class="home-section bg-white">
		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h3>Discoteca Oneyda Alvarenga</h3>
                    

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            <h5><?php if(isset($mensagem)){ echo $mensagem; } ?>
                   

            	</div>
             </div>
				<br />             
				<?php 
				while($res = mysqli_fetch_array($resultado)){
				
				?>
	            <div class="form-group">
		            <div class="col-md-offset-2 col-md-8">
               <div class="left">
				<h6><?php echo $res['idAcervo']; ?></h6>
				<p>
				<?php 
				switch($res['acervo']){
				
				case 1:
				echo "Biblioteca";
				break;

				case 2:
				echo "Acervo de Artes";
				break;

				case 3:
				echo "Museu Histórico";
				break;
				
					
					
				}
				
				?>
                <p>			
               </div>
				</div>		            
        	    </div>
        	    <?php 
        	    } ?>
<div class="form-group">
            <div class="col-md-offset-2 col-md-8">
	           <br /><br />            
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
					 <h2>Discoteca Oneyda Alvarenga</h2>
                     <p>Os campos em que ocorrerá a busca são: título, autor, assunto</p>
                     <p>É possível pesquisar por parte da palavra. Deve-se ter pelo menos 3 caracteres para busca.</p>
                    

					</div>
				  </div>
			  </div>
			  
	        <div class="row">
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-8">
            <h5><?php if(isset($mensagem)){ echo $mensagem; } ?>
                        <form method="POST" action="?" class="form-horizontal" role="form">
            		<label>Busca por palavras</label>
                    
                    
            		<input type="text" name="pesquisa" class="form-control" id="palavras" placeholder="" ><br />

            	</div>
             </div>
				<br />             
	            <div class="form-group">
		            <div class="col-md-offset-2 col-md-8">
                	<input type="hidden" name="pesquisar" value="1" />
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
