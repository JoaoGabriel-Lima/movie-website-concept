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

Class Usuario
{
    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        try
        {
          $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e) {
          $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $telefone, $email, $senha)
    {
        global $pdo;
        //verificar se já existe um email cadastrado
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
          return false;
        } else {
          //Se não tiver, cadastrar
          $sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
          $sql->bindValue(":n",$nome);
          $sql->bindValue(":t",$telefone);
          $sql->bindValue(":e",$email);
          $sql->bindValue(":s",md5($senha));
          $sql->execute();
          return true;
        }
    }

    public function logar($email, $senha) {
        global $pdo;
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        if($sql->rowCount() > 0) {
          $dado = $sql->fetch();
          session_start();
          $_SESSION['id_usuario'] = $dado['id_usuario'];
          $_SESSION['email'] = $email;
          return true;
        } else {
          return false;
        } //Fechar else 
    } //Fechar função Logar

    public function receber() {
      global $pdo;
      $sql = $pdo->prepare("SELECT nome FROM usuarios WHERE id_usuario = :i");
      $sql->bindValue(":i",$_SESSION['id_usuario']);
      $sql->execute();
      if($sql->rowCount() > 0) {
          $nome = $sql->fetch();
          $_SESSION['nome'] = $nome['nome'];
          return true;
        } else {
          return false;
      }
    } //Fechar função receber
} //Fechar Classe

?>
