<?php

namespace App\Ast;

interface Expression extends Node
{
    public function expressionNode(): void;
}

