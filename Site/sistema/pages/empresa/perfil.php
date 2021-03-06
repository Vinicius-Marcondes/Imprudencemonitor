﻿<!DOCTYPE html>
<html>
    <head>
		<?php session_start(); include_once('includes/header.php'); ?>
        <title>MDI - PERFIL</title>
    </head>
    <body class="fixed-left">
        <div id="wrapper">
            <?php include_once('includes/menu.php'); ?>                   
            <div class="content-page">
                <div class="content">
					<div class="wraper container-fluid">
						<div class="row">
							<div class="col-sm-12">
								<div class="bg-picture text-center" style="background-image:url('../../images/big/bg.jpg')">
									<div class="bg-picture-overlay"></div>
									<div class="profile-info-name">
										<img src="../../images/1_empresas/<?php echo $_SESSION['logo']; ?>" class="thumb-lg img-circle img-thumbnail" alt="profile-image">
										<h3 class="text-white"><?php echo $_SESSION['nome']; ?></h3>
									</div>
								</div>
							</div>
						</div>
						<?php 
							if(isset($_GET["page"])){
								$page = $_GET["page"];
							} else {
								$page = "1";
							}
						?>
						<div class="row user-tabs">
							<div class="col-lg-6 col-md-9 col-sm-9">
								<ul class="nav nav-tabs tabs">
									<li class="<?php if($page == "1"){ echo "active"; } ?> tab">
										<a href="#home-2" data-toggle="tab" aria-expanded="false" class="<?php if($page == "1"){ echo "active"; } ?>"> 
											<span class="visible-xs"><i class="fa fa-home"></i></span> 
											<span class="hidden-xs">Sobre</span> 
										</a> 
									</li> 
									<li class="<?php if($page == "2"){ echo "active"; } ?> tab"> 
										<a href="#profile-2" data-toggle="tab" aria-expanded="false" class="<?php if($page == "2"){ echo "active"; } ?>"> 
											<span class="visible-xs"><i class="fa fa-user"></i></span> 
											<span class="hidden-xs">Notificações</span> 
										</a> 
									</li> 
									<li class="<?php if($page == "4"){ echo "active"; } ?> tab"> 
										<a href="#settings-2" data-toggle="tab" aria-expanded="false" class="<?php if($page == "4"){ echo "active"; } ?>"> 
											<span class="visible-xs"><i class="fa fa-cog"></i></span> 
											<span class="hidden-xs">Configurações</span> 
										</a> 
									</li> 
									<div class="indicator"></div>
								</ul> 
							</div>
						</div>
						<div class="row">
							<?php 
								$selecao_empresa = "SELECT * FROM empresa WHERE ID_EMPRESA = $_SESSION[id]";
								$consulta_empresa = $conexao_bd->query($selecao_empresa);
								$empresa = mysqli_fetch_array($consulta_empresa);
								$selecao_funcionarios = "SELECT * FROM pessoas WHERE EMPRESA_ID_PESSOAS = $_SESSION[id]";
								$consulta_funcionarios = $conexao_bd->query($selecao_funcionarios);
								$cont = $consulta_funcionarios->num_rows;
							?>
							<div class="col-lg-12"> 
								<div class="tab-content profile-tab-content"> 
									<div class="tab-pane <?php if($page == "1"){ echo "active"; } ?>" id="home-2"> 
										<div class="row">
											<div class="col-md-12">
												<div class="panel panel-border panel-primary">
													<div class="panel-heading"> <h3 class="panel-title">Informações da empresa</h3> </div> 
													<div class="panel-body"> 
														<div class="about-info-p"><strong>Nome</strong><br/><p class="text-muted"><?php echo $empresa['NOME_EMPRESA']; ?></p></div>
														<div class="about-info-p"><strong>Telefone</strong><br/><p class="text-muted"><?php echo $empresa['TELEFONE_EMPRESA']; ?></p></div>
														<div class="about-info-p"><strong>Email</strong><br/><p class="text-muted"><?php echo $empresa['EMAIL_EMPRESA']; ?></p></div>
														<div class="about-info-p"><strong>CNPJ</strong><br/><p class="text-muted"><?php echo $empresa['CNPJ_EMPRESA']; ?></p></div>
														<div class="about-info-p"><strong>CEP</strong><br/><p class="text-muted"><?php echo $empresa['CEP_EMPRESA']; ?></p></div>
														<div class="about-info-p m-b-0"><strong>Quantidade de funcionários</strong><br/><p class="text-muted"><?php echo $cont; ?></p></div>

													</div> 
												</div>
											</div>
										</div>
									</div> 
									<div class="tab-pane <?php if($page == "2"){ echo "active"; } ?>" id="profile-2">
										<div class="row">
											<div class="col-md-12">
												<div class="panel panel-border panel-primary">
													<div class="panel-heading"> <h3 class="panel-title">Notificações</h3> </div> 
													<div class="panel-body">
													<?php 
														$selecao_notificacao = "SELECT * FROM notificacoes WHERE PESSOAS_ID_NOTIFICACOES = $_SESSION[id] AND TIPO_NOTIFICACOES = 'contratação'";
														$consulta_notificacao = $conexao_bd->query($selecao_notificacao);
														if($consulta_notificacao->num_rows > 0){
															while ($notificacao = mysqli_fetch_array($consulta_notificacao)) {
													?>
													<div class="alert alert-success fade in">
                                          				<h4>Emprego</h4>
                                           				<p><?php echo $notificacao['MENSAGEM_NOTIFICACOES']; ?></p>
                                           				<p>
                                           					<form action="processos/vincular_funcionario.php" method="Post">
                                              					<button type="submit" name="true" value="<?php echo $notificacao['EMPRESA_ID_NOTIFICACOES']; ?>" class="btn btn-success waves-effect waves-light">Aceitar</button>
                                              					<button type="submit" name="false" value="<?php echo $notificacao['EMPRESA_ID_NOTIFICACOES']; ?>" class="btn btn-default waves-effect">Negar</button>
                                              				</form>
                                            			</p>
                                       				 </div>
													<?php 
															}
														} else {
															echo "Nenhuma notificação";
														}
													?>
													</div> 
												</div>
											</div>
										</div>
									</div> 
									<div class="tab-pane <?php if($page = "4"){ echo "active"; } ?>" id="settings-2">
										<div class="panel panel-border panel-primary">
											<div class="panel-heading"> <h3 class="panel-title">Configurações gerais da conta</h3> </div> 
											<div class="panel-body">
												<?php if(isset($_SESSION['msg_perfil_1'])){ echo $_SESSION['msg_perfil_1']; unset($_SESSION['msg_perfil_1']); } ?>
												<form role="form" method="post" action="processos/editar_empresa.php">
													<div class="form-group">
														<label for="Nome">Nome</label>
														<input type="text" value="<?php echo $empresa['NOME_EMPRESA']; ?>" id="Nome" name="nome" class="form-control">
													</div>
													<div class="form-group">
														<label for="Email">Email</label>
														<input type="email" value="<?php echo $empresa['EMAIL_EMPRESA']; ?>" id="Email" name="email" class="form-control">
													</div>
													<div class="form-group">
														<label for="CPF">CNPJ</label>
														<input type="text" value="<?php echo $empresa['CNPJ_EMPRESA']; ?>" id="CNPJ" name="cnpj" class="form-control" pattern=".{14,14}" title="Necessário 14 digitos">
													</div>
													<button class="btn btn-primary waves-effect waves-light w-md" type="submit" name="btn" value="1">Salvar</button>
												</form>
											</div> 
										</div>
										<div class="panel panel-border panel-primary">
											<div class="panel-heading"> <h3 class="panel-title">Imagem de perfil</h3> </div> 
											<div class="panel-body"> 
												<?php if(isset($_SESSION['msg_perfil_2'])){ echo $_SESSION['msg_perfil_2']; unset($_SESSION['msg_perfil_2']); } ?>
												<form role="form" method="post" enctype="multipart/form-data" action="processos/editar_empresa.php">
													<div class="form-group">
														<div class="fileUpload btn btn-warning waves-effect waves-light">
															<span><i class="ion-upload m-r-5"></i>Upload</span>
															<input type="file" class="upload" name="arquivo">
														</div>
													</div>
													<button class="btn btn-primary waves-effect waves-light w-md" type="submit" name="btn" value="5">Salvar</button>
												</form>
											</div> 
										</div>
										<div class="panel panel-border panel-primary">
											<div class="panel-heading"> <h3 class="panel-title">Ferramentas de privacidade e segurança</h3> </div> 
											<div class="panel-body"> 
												<?php if(isset($_SESSION['msg_perfil_3'])){ echo $_SESSION['msg_perfil_3']; unset($_SESSION['msg_perfil_3']); } ?>
												<form role="form" method="post" action="editar_senha.php">
													<div class="form-group">
														<label for="Password">Senha antiga</label>
														<input type="password" placeholder="************" id="Password" class="form-control" name="senha_antiga" pattern=".{6,12}" title="6 até 12 caracteres">
													</div>
													<button class="btn btn-primary waves-effect waves-light w-md" type="submit">Avançar</button>
												</form>
											</div> 
										</div>
										<div class="panel panel-border panel-primary">
											<div class="panel-heading"> <h3 class="panel-title">Configurações móveis</h3> </div> 
											<div class="panel-body"> 
												<?php if(isset($_SESSION['msg_perfil_4'])){ echo $_SESSION['msg_perfil_4']; unset($_SESSION['msg_perfil_4']); } ?>
												<form role="form" method="post" action="processos/editar_empresa.php">
													<div class="form-group">
														<label for="Telefone">Telefone</label>
														<input type="text" value="<?php echo $empresa['TELEFONE_EMPRESA']; ?>" id="Telefone" name="telefone" class="form-control" pattern=".{10,11}" title="10 até 11 digitos">
													</div>
													<button class="btn btn-primary waves-effect waves-light w-md" type="submit" name="btn" value="3">Salvar</button>
												</form>
											</div> 
										</div>
										<div class="panel panel-border panel-primary">
											<div class="panel-heading"> <h3 class="panel-title">Localização</h3> </div> 
											<div class="panel-body"> 
												<?php if(isset($_SESSION['msg_perfil_5'])){ echo $_SESSION['msg_perfil_5']; unset($_SESSION['msg_perfil_5']); } ?>
												<form role="form" method="post" action="processos/editar_empresa.php">
													<div class="form-group">
														<label for="CEP">CEP</label>
														<input type="text" value="<?php echo $empresa['CEP_EMPRESA']; ?>" id="CEP" name="cep" class="form-control" pattern=".{8,8}" title="Necessário 8 digitos">
													</div>
													<button class="btn btn-primary waves-effect waves-light w-md" type="submit" name="btn" value="4">Salvar</button>
												</form>
											</div> 
										</div>
									</div> 
								</div> 
							</div>
						</div>
					</div> 
                </div> 
            </div>
        </div>
		<?php include_once('includes/scripts_ok.php'); ?>
	</body>
</html>