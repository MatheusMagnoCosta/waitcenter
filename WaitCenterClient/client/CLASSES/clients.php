<?php

class Usuario
{
  private $pdo;
  public $msgErro;

  public function conectar($nome, $host, $usuario, $senha)
  {
    global $msgErro;
    global $pdo;

    try {
      $pdo = new PDO("mysql:dbname=" . $nome . ";host=" . $host, $usuario, $senha);
    } catch (PDOException $e) {
      $msgErro = $e->getMessage();
      echo "Falha ao conectar \n ".$e;
    }
  }

  public function cadastrar($nome,$sobrenome,$email,$senha)
  {
    global $pdo;
    $sql = $pdo->prepare("SELECT idUsuario FROM bd_cliente WHERE email = :e ");
    $sql->bindValue(":e", $email);
    $sql->execute();
    if ($sql->rowCount() > 0) {
      echo "Usuario já existente";
      return false;
    } else {
      $sql = $pdo->prepare("INSERT INTO bd_cliente(nome,sobrenome,email,senha) VALUES (:n,:sn,:e,:s)");
      $sql->bindValue(":n", $nome);
      $sql->bindValue(":sn", $sobrenome);
      $sql->bindValue(":e", $email);
      $sql->bindValue(":s", md5($senha));
      $sql->execute();
      return true;
    }
  }

  public function logar($email, $senha)
  {

    global $pdo;
    $sql = $pdo -> prepare("SELECT * FROM bd_cliente WHERE email = :e AND senha = :s");
    $sql ->bindValue(":e",$email);
    $sql ->bindValue(":s",$senha);
    $sql -> execute();
    if($sql->rowCount()>0){
      $dado = $sql->fetch();
      session_start();
      return true;
      $_SESSION['id_usuario'] = $dado['id_usuario'];
      $_SESSION['nome'] = $dado['nome'];
    }else{
      return false;
    }

  }
}
