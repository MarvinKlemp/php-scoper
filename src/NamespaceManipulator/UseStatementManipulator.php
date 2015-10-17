<?php

namespace Webmozart\PhpScoper\NamespaceManipulator;

use PhpParser\Node;

class UseStatementManipulator implements NamespaceManipulator
{
    /**
     * @var string
     */
    private $prefix;

    /**
     * @param string $prefix
     */
    public function __construct($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @param Node $node
     *
     * @return bool
     */
    public function supports(Node $node)
    {
        if ($node instanceof Node\Stmt\Use_) {
            return true;
        }

        return false;
    }

    /**
     * @param Node $node
     *
     * @return Node
     */
    public function manipulate(Node $node)
    {
        if (!$node instanceof Node\Stmt\Use_) {
            throw new \RuntimeException();
        }

        $node->uses[0]->name->prepend($this->prefix);

        return $node;
    }
}
