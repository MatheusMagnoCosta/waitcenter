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

  public function cadastrar($nome, $email, $senha,$sobrenome,$telefone,$cargo,$ambiente,$nivel)
  {
    global $pdo;
    $sql = $pdo->prepare("SELECT idUsuario FROM Usuario WHERE email = :e ");
    $sql->bindValue(":e", $email);
    $sql->execute();
    if ($sql->rowCount() > 0) {
      echo "Usuario já existente";
      return false;
    } else {
      $sql = $pdo->prepare("INSERT INTO Usuario(nome,email,senha,sobrenome,nivel,telefone,cargo,ambiente) VALUES (:n,:e,:s,:sn,:nv,:t,:c,:a)");
      $sql->bindValue(":n", $nome);
      $sql->bindValue(":e", $email);
      $sql->bindValue(":s", md5($senha));
      $sql->bindValue(":sn", $sobrenome);
      $sql->bindValue(":nv", $nivel);
      $sql->bindValue(":t", $telefone);
      $sql->bindValue(":c", $cargo);
      $sql->bindValue(":a", $ambiente);
      $sql->execute();
      return true;
    }
  }

  public function logar($email, $senha)
  {

    global $pdo;
    $sql = $pdo -> prepare("SELECT * FROM Usuario WHERE email = :e AND senha = :s");
    $sql ->bindValue(":e",$email);
    $sql ->bindValue(":s",$senha);
    $sql -> execute();
    if($sql->rowCount()>0){
      $dado = $sql->fetch();
      session_start();
      $_SESSION['idUsuario'] = $dado['idUsuario'];
      $_SESSION['nome'] = $dado['nome'];
      $_SESSION['nivel'] = $dado['nivel'];
      return true;
    }else{
      return false;
    }

  }
}
