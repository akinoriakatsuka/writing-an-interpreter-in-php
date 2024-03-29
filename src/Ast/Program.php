<?php

declare(strict_types=1);

namespace App\Ast;

class Program implements Node
{
    /** @var array<Node> */
    public $statements = [];

    public function tokenLiteral(): string
    {
        if (count($this->statements) > 0) {
            return $this->statements[0]->tokenLiteral();
        } else {
            return '';
        }
    }
}
