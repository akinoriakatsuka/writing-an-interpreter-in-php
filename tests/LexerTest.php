<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Token\Token;
use App\Lexer\Lexer;

class LexerTest extends TestCase
{
    public function testNextToken(): void
    {
        $input = "=+(){},;";

        $tests = [
            [Token::ASSIGN, "="],
            [Token::PLUS, "+"],
            [Token::LPAREN, "("],
            [Token::RPAREN, ")"],
            [Token::LBRACE, "{"],
            [Token::RBRACE, "}"],
            [Token::COMMA, ","],
            [Token::SEMICOLON, ";"],
            [Token::EOF, ""],
        ];

        $lexer = new Lexer($input);

        foreach ($tests as $test) {
            $token = $lexer->nextToken();

            $this->assertEquals($token->type, $test[0]);
            $this->assertEquals($token->literal, $test[1]);
        }
    }
}