<?php

namespace App\Lexer;

use App\Token\Token;

class Lexer {
    private $input;
    private $position;
    private $readPosition;
    private $ch;

    public function __construct($input) {
        $this->input = $input;
        $this->position = 0;
        $this->readPosition = 0;
        $this->readChar();
    }

    public function nextToken() {

        switch ($this->ch) {
            case '=':
                $token = $this->newToken(Token::ASSIGN, $this->ch);
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
            case '+':
                $token = $this->newToken(Token::PLUS, $this->ch);
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
        }

        $this->readChar();

        return $token;
    }

    private function newToken($type, $ch) {
        return new Token($type, $ch);
    }

    private function readChar() {
        if ($this->readPosition >= strlen($this->input)) {
            $this->ch = 0;
        } else {
            $this->ch = $this->input[$this->readPosition];
        }

        $this->position = $this->readPosition;
        $this->readPosition += 1;
    }
}