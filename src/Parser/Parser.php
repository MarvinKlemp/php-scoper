<?php

namespace Webmozart\PhpScoper\Parser;

use PhpParser\Lexer;
use PhpParser\NodeTraverser;
use Symfony\Component\Finder\SplFileInfo;

class Parser extends \PhpParser\Parser
{
    private $traverser;

    public function __construct(NodeTraverser $baseTraverser)
    {
        parent::__construct(new Lexer());

        $this->traverser = $baseTraverser;
    }

    public function parseFile(SplFileInfo $file)
    {
        $nodes = $this->parse($file->getContents());

        return $this->traverser->traverse($nodes);
    }
}
