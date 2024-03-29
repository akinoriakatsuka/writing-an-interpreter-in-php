<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Parser\Parser;
use App\Lexer\Lexer;
use App\Ast\Statement;
use App\Ast\LetStatement;

class ParserTest extends TestCase
{
    public function testLetStatements(): void
    {
        $input = <<<END
        let x = 5;
        let y = 10;
        let foobar = 838383;
        END;

        $lexer = new Lexer($input);
        $parser = new Parser($lexer);

        $program = $parser->parseProgram();

        $this->assertNotNull($program);
        $this->assertCount(3, $program->statements);

        $tests = [
            "x",
            "y",
            "foobar",
        ];

        foreach ($tests as $i => $ident) {
            $stmt = $program->statements[$i];
            if (!$this->_testLetStatement($stmt, $ident)){
                return;
            }
        }
    }

    private function _testLetStatement(Statement $stmt, string $name): bool
    {
        $letStmt = $stmt;
        if ($letStmt->tokenLiteral() !== "let") {
            $this->fail("stmt->tokenLiteral not 'let'. got={$letStmt->tokenLiteral()}");
        }

        if ($letStmt->name->value !== $name) {
            $this->fail("stmt->name->value not '$name'. got={$letStmt->name->value}");
        }

        if ($letStmt->name->tokenLiteral() !== $name) {
            $this->fail("stmt->name->tokenLiteral not '$name'. got={$letStmt->name->tokenLiteral()}");
        }

        return true;
    }
}