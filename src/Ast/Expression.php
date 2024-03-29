<?php

declare(strict_types=1);

namespace App\Ast;

interface Expression extends Node
{
    public function expressionNode(): void;
}
