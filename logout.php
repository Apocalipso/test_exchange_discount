<?php
require_once __DIR__ . '/init.php';

unset($_SESSION['login']);
unset($_SESSION['authorization']);
unset($_SESSION['userName']);
unset($_SESSION['balance']);

header("Location:/");
exit();