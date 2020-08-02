<?php
  session_start();
  if(!isset($_SESSION['id_usuario']))
  {
    header("location: ../Login/login.php");
    exit;
  }
?>
<?php
  require_once '../usuarios.php';
  $u = new Usuario;
  $u->conectar("projeto_login","localhost","root","ben10emario");
  if($u->msgErro == "") {
    $u->receber();
  } else {
    return null;
  }
?>
<html>
  <head>
  <meta charset="utf-8"/>
  <title>Nextfilmes | Filmes</title>
  </head>
  <body>
    <nav>
      <a href="#" class="logo">NEXTFILMES.</a>
      <ul class="desktop">
        <li><a href="#">Início</a>
        <li><a href="#">Filmes</a></li>
        <li><a href="#">Séries</a></li>
        <li><a href="#">Minha lista</a></li>
        <li><a href="../Movies/movies.php">Registre-se / Login</a></li>
      </ul>
      <div class="mobile">
        <label for="toggle">&#9776;</label>
        <input type="checkbox" id="toggle"/>
        <ul>
          <li><a href="#">Novidades</a></li>
          <li><a href="#">Premium</a></li>
          <li><a href="Movies/movies.php">Registre-se / Login</a></li>
        </ul>
      </div>
    </nav>
    <a href="deslogar.php"><input type="button" name="deslogar" value="Deslogar"></a>
  </body>
</html>
