<?php
require_once '../usuarios.php';
$u = new Usuario;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
	<title>Nextfilmes | Login</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.png">
		</div>
		<div class="login-content">
			<form method="post">
				<img src="img/avatar_novo.png">
				<h2 class="title">Bem-vindo</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-envelope"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Endereço de Email</h5>
           		   		<input type="text" name="email" class="input username" maxlength="30">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i">
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Senha</h5>
           		    	<input type="password" name="senha" class="input password" maxlength="32">
            	   </div>
            	</div>
            	<input type="submit" class="btn" value="Login">
							<a href="#">Esqueceu a senha?</a>
							<a href="../Registro/cadastrar.php" class="registro">É novo? Registre-se</a>
            <?php
            if (isset($_POST['email'])) {
              $email = addslashes($_POST['email']);
              $senha = ($_POST['senha']);

              if(!empty($email) && !empty($senha)) {

                $u->conectar("projeto_login","localhost","root","ben10emario");
                if($u->msgErro == "") {
                  if($u->logar($email,$senha)) {
                    ?>
                    <div class="msg-erro">Logado com Sucesso! Faça Login Para Entrar</div>
                    <?php
                    header("location: ../Movies/movies.php");
                  } else {
                    ?>
                    <div class="msg-erro">Não foi possivel logar</div>
                    <?php
                  }
              }else {
                ?>
                <div class="msg-erro">
                <?php echo "Erro: ".$u->msgErro; ?>
                </div>
                <?php
              }
            } else {
              ?>
              <div class="msg-erro">Preencha todos os campos</div>
              <?php
              }
            }
            ?>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>
