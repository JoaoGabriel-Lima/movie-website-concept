<!--
 ________
|        \
| $$$$$$$$______   __    __  __    __
| $$__   /      \ |  \  /  \|  \  |  \
| $$  \ |  $$$$$$\ \$$\/  $$| $$  | $$
| $$$$$ | $$  | $$  >$$  $$ | $$  | $$
| $$    | $$__/ $$ /  $$$$\ | $$__/ $$
| $$     \$$    $$|  $$ \$$\ \$$    $$
 \$$      \$$$$$$  \$$   \$$ _\$$$$$$$
                            |  \__| $$
                             \$$    $$
                              \$$$$$$
-->
<?php
  require_once '../usuarios.php';
  $u = new Usuario
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8"/>
        <title>Nextfilmes | Registro</title>
        <link rel="stylesheet" type="text/css" href="../Registro/css/style.css">
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
        <div class="register-content" id="corpo-form-cad">
            <form method="post">
              <img src="img/avatar_novo.png">
              <h2 class="title">Cadastre-se</h2>
              <div class="input-div one">
                 <div class="i">
                    <i class="fas fa-user"></i>
                 </div>
                 <div class="div">
                    <h5>Nome de Usuário</h5>
                    <input type="text" name="nome" class="input" maxlength="30">
                 </div>
              </div>
              <div class="input-div one">
                 <div class="i">
                    <i class="fas fa-phone"></i>
                 </div>
                 <div class="div">
                    <h5>Telefone</h5>
                    <input type="number" name="telefone" class="input" maxlength="30">
                 </div>
              </div>
              <div class="input-div one">
                 <div class="i">
                    <i class="fas fa-envelope"></i>
                 </div>
                 <div class="div">
                    <h5>Endereço de Email</h5>
                    <input type="email" name="email" class="input" maxlength="40">
                 </div>
              </div>
                <div class="input-div pass">
                   <div class="i">
                      <i class="fas fa-lock"></i>
                   </div>
                   <div class="div">
                      <h5>Senha</h5>
                      <input type="password" name="senha" class="input" maxlength="32">
                   </div>
                </div>
                <div class="input-div pass">
                   <div class="i">
                      <i class="fas fa-lock"></i>
                   </div>
                   <div class="div">
                      <h5>Confirmar Senha</h5>
                      <input type="password" name="confSenha" class="input" maxlength="32">
                   </div>
                </div>
                <input type="submit" value="Acessar" class="btn">
                <a href="../Login/login.php" class="logar">Já é cadastrado? Faça Login</a>
                <?php //Parte do PHP
                  if (isset($_POST['nome'])) {
                    $nome = addslashes($_POST['nome']);
                    $telefone = addslashes($_POST['telefone']);
                    $email = addslashes($_POST['email']);
                    $senha = ($_POST['senha']);
                    $confirmarSenha = ($_POST['confSenha']);

                    if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)) {
                      $u->conectar("projeto_login","localhost","root","ben10emario");
                      if($u->msgErro == "") {
                        if($senha == $confirmarSenha) {
                          if($u->cadastrar($nome,$telefone,$email,$senha)) {
                            ?>
                            <div id="msg-sucesso">Cadastrado com Sucesso! Faça Login Para Entrar</div>
                            <?php
                            header("location: ../Login/login.php");
                          } else {
                            ?>
                            <div class="msg-erro">Email ja cadastrado!</div>
                            <?php
                          }
                        } else {
                          ?>
                          <div class="msg-erro">Senha e Confirmar Senha não correspondem!</div>
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
                      <div class="msg-erro">preencha todos os campos!</div>
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
