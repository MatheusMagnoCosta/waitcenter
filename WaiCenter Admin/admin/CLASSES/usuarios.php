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

  public function cadastrar($nome, $email, $senha)
  {
    global $pdo;
    $sql = $pdo->prepare("SELECT idUsuario FROM Usuario WHERE email = :e ");
    $sql->bindValue(":e", $email);
    $sql->execute();
    if ($sql->rowCount() > 0) {
      echo "Usuario já existente";
      return false;
    } else {
      $sql = $pdo->prepare("INSERT INTO Usuario(nome,email,senha) VALUES (:n,:e,:s)");
      $sql->bindValue(":n", $nome);
      $sql->bindValue(":e", $email);
      $sql->bindValue(":s", md5($senha));
      $sql->execute();
      echo "Cadastrado";
      return true;
    }
  }

  public function logar($email, $senha)
  {

    global $pdo;
    $sql = $pdo -> prepare("SELECT idUsuario FROM Usuario WHERE email = :e AND senha = :s");
    $sql ->bindValue(":e",$email);
    $sql ->bindValue(":s",$senha);
    $sql -> execute();
    if($sql->rowCount()>0){
      $dado = $sql->fetch();
      $_SESSION['idUsuario'] = $dado['idUsuario'];
      return true;
    }else{
      return false;
    }

  }
}
