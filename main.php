<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Repl\Repl;

echo "Welcome to the Monkey programming language!\n";
echo "Feel free to type in commands\n";
$repl = new Repl();
$repl->start();