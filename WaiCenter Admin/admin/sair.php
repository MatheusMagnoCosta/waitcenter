<?php
session_start();
unset($_SESSION['idUsuario']);
header("location: login.php");
?>