<?php

declare(strict_types=1);

namespace App\Ast;

interface Statement extends Node
{
    public function statementNode(): void;
}
