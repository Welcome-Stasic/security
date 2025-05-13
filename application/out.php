<?php
session_start();
$_SESSION['auth'] = false;
session_destroy();
header('Location: ../index.php');