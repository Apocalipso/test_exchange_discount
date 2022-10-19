<?php

session_start();

require_once __DIR__ . '/functions/db.php';
require_once __DIR__ . '/functions/template.php';

$config = require __DIR__ . '/config.php';

$link = dbConnect($config);
