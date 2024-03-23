<?php

namespace App\Ast;

use App\Token\Token;

class Identifier implements Expression
{
    public Token $token;
    public string $value;

    public function expressionNode(): void
    {
    }

    public function tokenLiteral(): string
    {
        return $this->token->literal;
    }
}

