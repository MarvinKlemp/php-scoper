<?php

namespace Webmozart\PhpScoper\Parser;

use PhpParser\Lexer;
use Symfony\Component\Finder\SplFileInfo;

class Parser extends \PhpParser\Parser
{
    public function __construct()
    {
        parent::__construct(new Lexer());
    }

    public function parseFile(SplFileInfo $file)
    {
    }
}