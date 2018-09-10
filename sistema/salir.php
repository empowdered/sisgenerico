<?php
session_name("login_permisos");
session_start();
session_unset();
session_destroy();
header("Location: ../index.php?mensaje=Ha salido del sistema");
?>