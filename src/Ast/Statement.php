<?php

namespace App\Ast;

interface Statement extends Node
{
    public function statementNode(): void;
}

