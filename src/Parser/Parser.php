<?php

namespace App\Parser;

use App\Lexer\Lexer;
use App\Token\Token;
use App\Ast\Program;
use App\Ast\Statement;
use App\Ast\LetStatement;
use App\Ast\Identifier;

class Parser
{
    private Lexer $lexer;
    private Token $currentToken;
    private Token $peekToken;

    public function __construct(Lexer $lexer)
    {
        $this->lexer = $lexer;

        $this->nextToken();
        $this->nextToken();
    }

    public function parseProgram(): Program
    {
        $program = new Program();

        while ($this->currentToken->type !== Token::EOF) {
            $stmt = $this->parseStatement();

            if ($stmt !== null) {
                $program->statements[] = $stmt;
            }

            $this->nextToken();
        }

        return $program;
    }

    private function nextToken(): void
    {
        if (isset($this->peekToken)) {
            $this->currentToken = $this->peekToken;
        }
        $this->peekToken = $this->lexer->nextToken();
    }

    private function parseStatement(): ?Statement
    {
        switch ($this->currentToken->type) {
            case Token::LET:
                return $this->parseLetStatement();
            default:
                return null;
        }
    }

    private function parseLetStatement(): ?LetStatement
    {
        $stmt = new LetStatement($this->currentToken);

        if (!$this->expectPeek(Token::IDENT)) {
            return null;
        }

        $stmt->name = new Identifier($this->currentToken, $this->currentToken->literal);

        if (!$this->expectPeek(Token::ASSIGN)) {
            return null;
        }

        // TODO: We're skipping the expressions until we encounter a semicolon
        while (!$this->currentTokenIs(Token::SEMICOLON)) {
            $this->nextToken();
        }

        return $stmt;
    }

    private function currentTokenIs(string $type): bool
    {
        return $this->currentToken->type === $type;
    }

    private function peekTokenIs(string $type): bool
    {
        return $this->peekToken->type === $type;
    }

    private function expectPeek(string $type): bool
    {
        if ($this->peekTokenIs($type)) {
            $this->nextToken();
            return true;
        } else {
            return false;
        }
    }
}
