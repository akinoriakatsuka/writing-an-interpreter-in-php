<?php

declare(strict_types=1);

namespace App\Ast;

use App\Token\Token;

class LetStatement implements Statement
{
    public Token $token;
    public Identifier $name;
    public Expression $value;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function statementNode(): void
    {
    }

    public function tokenLiteral(): string
    {
        return $this->token->literal;
    }
}
