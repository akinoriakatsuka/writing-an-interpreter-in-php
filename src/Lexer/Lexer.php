<?php

declare(strict_types=1);

namespace App\Lexer;

use App\Token\Token;

class Lexer
{
    private string $input;
    private int $position;
    private int $readPosition;
    private int|string $ch;

    public function __construct(string $input)
    {
        $this->input = $input;
        $this->position = 0;
        $this->readPosition = 0;
        $this->readChar();
    }

    public function nextToken(): Token
    {

        $this->skipWhitespace();

        switch ($this->ch) {
            case '=':
                if ($this->peekChar() === '=') {
                    $ch = $this->ch;
                    $this->readChar();
                    $token = $this->newToken(Token::EQ, $ch . $this->ch);
                } else {
                    $token = $this->newToken(Token::ASSIGN, $this->ch);
                }
                break;
            case '+':
                $token = $this->newToken(Token::PLUS, $this->ch);
                break;
            case '-':
                $token = $this->newToken(Token::MINUS, $this->ch);
                break;
            case '!':
                if ($this->peekChar() === '=') {
                    $ch = $this->ch;
                    $this->readChar();
                    $token = $this->newToken(Token::NOT_EQ, $ch . $this->ch);
                } else {
                    $token = $this->newToken(Token::BANG, $this->ch);
                }
                break;
            case '/':
                $token = $this->newToken(Token::SLASH, $this->ch);
                break;
            case '*':
                $token = $this->newToken(Token::ASTERISK, $this->ch);
                break;
            case '<':
                $token = $this->newToken(Token::LT, $this->ch);
                break;
            case '>':
                $token = $this->newToken(Token::GT, $this->ch);
                break;
            case ';':
                $token = $this->newToken(Token::SEMICOLON, $this->ch);
                break;
            case '(':
                $token = $this->newToken(Token::LPAREN, $this->ch);
                break;
            case ')':
                $token = $this->newToken(Token::RPAREN, $this->ch);
                break;
            case ',':
                $token = $this->newToken(Token::COMMA, $this->ch);
                break;
            case '{':
                $token = $this->newToken(Token::LBRACE, $this->ch);
                break;
            case '}':
                $token = $this->newToken(Token::RBRACE, $this->ch);
                break;
            case 0:
                $token = $this->newToken(Token::EOF, "");
                break;
            default:
                if ($this->isLetter($this->ch)) {
                    $literal = $this->readIdentifier();
                    $token = $this->newToken(Token::lookupIdent($literal), $literal);
                    return $token;
                } elseif ($this->isDigit($this->ch)) {
                    $literal = $this->readNumber();
                    $token = $this->newToken(Token::INT, $literal);
                    return $token;
                } else {
                    $token = $this->newToken(Token::ILLEGAL, $this->ch);
                }
        }

        $this->readChar();

        return $token;
    }

    private function newToken(string $type, int|string $ch): Token
    {
        return new Token($type, (string) $ch);
    }

    private function readChar(): void
    {
        if ($this->readPosition >= strlen($this->input)) {
            $this->ch = 0;
        } else {
            $this->ch = $this->input[$this->readPosition];
        }

        $this->position = $this->readPosition;
        $this->readPosition += 1;
    }

    private function peekChar(): int|string
    {
        if ($this->readPosition >= strlen($this->input)) {
            return 0;
        } else {
            return $this->input[$this->readPosition];
        }
    }

    private function readNumber(): string
    {
        $position = $this->position;
        while ($this->isDigit($this->ch)) {
            $this->readChar();
        }
        return substr($this->input, $position, $this->position - $position);
    }

    private function readIdentifier(): string
    {
        $position = $this->position;
        while ($this->isLetter($this->ch)) {
            $this->readChar();
        }
        return substr($this->input, $position, $this->position - $position);
    }

    private function skipWhitespace(): void
    {
        while ($this->ch === ' ' || $this->ch === "\t" || $this->ch === "\n" || $this->ch === "\r") {
            $this->readChar();
        }
    }

    private function isLetter(int|string $ch): bool
    {
        if($ch === 0) {
            return false;
        }
        return ctype_alpha($ch) || $ch === '_';
    }

    private function isDigit(int|string $ch): bool
    {
        if($ch === 0) {
            return false;
        }
        return ctype_digit($ch);
    }
}
