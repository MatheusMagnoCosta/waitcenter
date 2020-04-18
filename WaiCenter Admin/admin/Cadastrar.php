<?php
require_once 'CLASSES/usuarios.php';
$u = new Usuario;
$u->conectar("u963859304_waitcenter", "sql125.main-hosting.eu", "u963859304_waitcenter", "abacaxi");
?>

<!DOCTYPE html>
<html lang="pt_BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Cadastrar - WaitCenter</title>
    <link href="dist/css/pages/login-register-lock.css" rel="stylesheet">
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>

<body class="skin-blue card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">WaitCenter</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(../assets/images/background/login-register.jpg);">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" method="POST" id="loginform">
                        <h3 class="box-title m-b-20">Cadastrar</h3>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="nome" placeholder="Nome">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" name="senha" placeholder="Senha">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" name="confSenha" placeholder="Confirmar Senha">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                    <label class="custom-control-label" for="customCheck1">Eu aceito todos os <a href="javascript:void(0)">Termos</a></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center p-b-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">Cadastrar</button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                Já possui uma conta? <a href="./login.php" class="text-info m-l-5"><b>Entrar</b></a>
                            </div>
                            <?php
                            if (isset($_POST['nome'])) {
                                $nome = addslashes($_POST['nome']);
                                $email = addslashes($_POST['email']);
                                $senha = addslashes($_POST['senha']);
                                $confSenha = addslashes($_POST['confSenha']);
                                if (!empty($nome) && !empty($email) && !empty($senha)) {
                                    if ($senha == $confSenha) {
                                        $u->cadastrar($nome, $email, $senha);
                                    } else {
                                        echo "As senhas não são iguais, tente novamente";
                                    }
                                } else {
                                    echo "Preencha todos os dados";
                                }
                            };


                            ?>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/node_modules/popper/popper.min.js"></script>
    <script src="../assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
    </script>
</body>

</html>