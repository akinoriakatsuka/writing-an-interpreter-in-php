<?php

namespace App\Token;

class Token
{
    public string $type;
    public int|string $literal;

    public function __construct(string $type, int|string $literal)
    {
        $this->type = $type;
        $this->literal = $literal;
    }

    const ILLEGAL = "ILLEGAL";
    const EOF = "EOF";

    // Identifiers + literals
    const IDENT = "IDENT"; // add, foobar, x, y, ...
    const INT = "INT"; // 1343456

    // Operators
    const ASSIGN = "=";
    const PLUS = "+";
    const MINUS = "-";
    const BANG = "!";
    const ASTERISK = "*";
    const SLASH = "/";

    const LT = "<";
    const GT = ">";

    const EQ = "==";
    const NOT_EQ = "!=";

    // Delimiters
    const COMMA = ",";
    const SEMICOLON = ";";

    const LPAREN = "(";
    const RPAREN = ")";
    const LBRACE = "{";
    const RBRACE = "}";

    // Keywords
    const FUNCTION = "FUNCTION";
    const LET = "LET";
    const TRUE = "TRUE";
    const FALSE = "FALSE";
    const IF = "IF";
    const ELSE = "ELSE";
    const RETURN = "RETURN";

    public static function lookupIdent(string $ident): string
    {
        $keywords = [
            "fn" => self::FUNCTION,
            "let" => self::LET,
            "true" => self::TRUE,
            "false" => self::FALSE,
            "if" => self::IF,
            "else" => self::ELSE,
            "return" => self::RETURN,
        ];

        return $keywords[$ident] ?? self::IDENT;
    }
}
