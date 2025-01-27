<?php

session_name('iniciar');
session_start();

$_SESSION['id_user'] = FALSE;

session_destroy();

header("location: login.php")

?>


