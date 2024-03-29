<?php

declare(strict_types=1);

namespace App\Token;

class Token
{
    public string $type;
    public string $literal;

    public function __construct(string $type, string $literal)
    {
        $this->type = $type;
        $this->literal = $literal;
    }

    public const ILLEGAL = "ILLEGAL";
    public const EOF = "EOF";

    // Identifiers + literals
    public const IDENT = "IDENT"; // add, foobar, x, y, ...
    public const INT = "INT"; // 1343456

    // Operators
    public const ASSIGN = "=";
    public const PLUS = "+";
    public const MINUS = "-";
    public const BANG = "!";
    public const ASTERISK = "*";
    public const SLASH = "/";

    public const LT = "<";
    public const GT = ">";

    public const EQ = "==";
    public const NOT_EQ = "!=";

    // Delimiters
    public const COMMA = ",";
    public const SEMICOLON = ";";

    public const LPAREN = "(";
    public const RPAREN = ")";
    public const LBRACE = "{";
    public const RBRACE = "}";

    // Keywords
    public const FUNCTION = "FUNCTION";
    public const LET = "LET";
    public const TRUE = "TRUE";
    public const FALSE = "FALSE";
    public const IF = "IF";
    public const ELSE = "ELSE";
    public const RETURN = "RETURN";

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
