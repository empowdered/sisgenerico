<?php
session_name("items");
session_start();
$_SESSION = array();
unset($_SESSION);
session_destroy();
header("Location: nuevaFicha.php");
?>