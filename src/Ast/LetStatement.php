<?php

namespace App\Ast;

use App\Token\Token;

class LetStatement
{
    public Token $token;
    public Identifier $name;
    public Expression $value;

    public function statementNode(): void
    {
    }

    public function tokenLiteral(): string
    {
        return $this->token->literal;
    }
}

