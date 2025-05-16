<?php
session_start();
$_SESSION['auth'] = false;
setcookie('username', $username, time() - (86400 * 30));
setcookie('useremail', $email, time() - (86400 * 30));
session_destroy();
header('Location: ../index.php');