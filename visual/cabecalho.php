<?php

//ini_set('session.gc_maxlifetime', 30*60); // 30 minutos

 session_start();
	if(!isset ($_SESSION['usuario']) == true) //verifica se há uma sessão, se não, volta para área de login
		{
			unset($_SESSION['usuario']);
			header('location:../index.php');
	}else{
		$logado = $_SESSION['usuario'];
		verificaSessao($_SESSION['idUsuario']);
	}
	

ini_set('session.gc_maxlifetime', 60*60*2); // 60 minutos

	?>

<!DOCTYPE html>
<html>
  <head>
    <title>Sistema Clara - Centro Cultural São Paulo</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
	<link href="color/default.css" rel="stylesheet" media="screen">


  <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<?php include "../include/script.php"; ?>
      </head>
  <body>
  <div id="bar">
  <p id="p-bar"><img src="images/logo_pequeno.png" /><?php echo saudacao(); ?>, <?php echo $_SESSION['nomeCompleto']; ?>  <g id="doc"></a> </p>
  </div>
