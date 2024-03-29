<?php

declare(strict_types=1);

namespace App\Ast;

interface Node
{
    public function TokenLiteral(): string;
}
