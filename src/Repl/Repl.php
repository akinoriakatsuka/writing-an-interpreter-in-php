<?php

declare(strict_types=1);

namespace App\Repl;

use App\Lexer\Lexer;
use App\Token\Token;

class Repl
{
    public const PROMPT = ">> ";

    public function start(): void
    {
        while (true) {
            $input = readline(self::PROMPT);
            if ($input === false) {
                return;
            }
            $l = new Lexer($input);
            for ($tok = $l->nextToken(); $tok->type !== Token::EOF; $tok = $l->nextToken()) {
                echo $tok->type . ' ' . $tok->literal . PHP_EOL;
            }
        }
    }
}
