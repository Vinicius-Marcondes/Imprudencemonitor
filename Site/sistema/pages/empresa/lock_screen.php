<!DOCTYPE html>
<?php 
	session_start(); if(!isset($_SESSION['email'])){ header('location: ../../index.php'); }
	require('../conexao_banco.php'); 
	$cod = $_SESSION['id'];
	$_SESSION['lock'] = true;
	unset($_SESSION['senha']);
	if(isset($_POST['senha'])){
		$senha = $conexao_bd->real_escape_string($_POST['senha']); 
		$senha = hash("sha256", hash("sha256", $senha));
		$selecao_pessoa = "SELECT * FROM empresa WHERE ID_EMPRESA = '$cod' AND SENHA_EMPRESA = '$senha'";
		$consulta_pessoa =  $conexao_bd->query($selecao_pessoa);
		if($consulta_pessoa->num_rows == 1){
			$_SESSION['senha'] = $senha;
			$_SESSION['lock'] = false;
			header('Location: index.php');
		} else {
			//$_SESSION['mensagem_lock'] = "<div class='alert alert-warning'><strong>Atenção!</strong> Este email já está em uso.</div>";
		}
	}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="../../images/favicon_1.ico">

        <title>MDI - LOGIN</title>

        <!-- Base Css Files -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" />

        <!-- Font Icons -->
        <link href="../../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="../../assets/ionicon/css/ionicons.min.css" rel="stylesheet" />
        <link href="../../css/material-design-iconic-font.min.css" rel="stylesheet">

        <!-- animate css -->
        <link href="../../css/animate.css" rel="stylesheet" />

        <!-- Waves-effect -->
        <link href="../../css/waves-effect.css" rel="stylesheet">

        <!-- Custom Files -->
        <link href="../../css/helper.css" rel="stylesheet" type="text/css" />
        <link href="../../css/style.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="../../js/modernizr.min.js"></script>
        
    </head>
    <body>


        <div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">

                <div class="panel-heading bg-img"> 
                    <div class="bg-overlay"></div>
                    <h3 class="text-center m-t-10 text-white">&nbsp;</h3>
                </div> 

                <div class="panel-body" style="padding-top:0px;">
                 <form method="post" action="lock_screen.php" role="form" class="text-center"> 
                    <div class="user-thumb"> 
                        <img src="../../images/1_empresas/<?php echo $_SESSION['logo']; ?>" class="img-responsive img-circle img-thumbnail" alt="thumbnail">
                    </div> 
                    <div class="form-group"> 
                        <h3><?php echo $_SESSION['nome']; ?></h3> 
                        <p class="text-muted">Coloque sua senha para retornar ao sistema.</p> 
                        <div class="input-group m-t-30"> 
                            <input type="password" class="form-control input-lg" placeholder="Senha" name="senha"> 
                            <span class="input-group-btn"> <button type="submit" class="btn btn-primary btn-lg waves-effect waves-light">Acessar</button> </span> 
                        </div> 
                    </div> 
                    <div class="text-right">
                        <a href="../sair_sistema.php">Esta não é sua conta?</a>
                    </div>
                </form>         

                </div>                                 
                
            </div>
        </div>

        
    	<script>
            var resizefunc = [];
        </script>
        <script src="../../js/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src="../../js/waves.js"></script>
        <script src="../../js/wow.min.js"></script>
        <script src="../../js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="../../js/jquery.scrollTo.min.js"></script>
        <script src="../../assets/jquery-detectmobile/detect.js"></script>
        <script src="../../assets/fastclick/fastclick.js"></script>
        <script src="../../assets/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="../../assets/jquery-blockui/jquery.blockUI.js"></script>


        <!-- CUSTOM JS -->
        <script src="../../js/jquery.app.js"></script>
	
	</body>
</html>