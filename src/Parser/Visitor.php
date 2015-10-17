<?php

namespace Webmozart\PhpScoper\Parser;

use PhpParser\Node;
use PhpParser\NodeVisitor;
use Webmozart\PhpScoper\NamespaceManipulator\NamespaceManipulator;

class Visitor implements NodeVisitor
{
    /**
     * @var NamespaceManipulator[]
     */
    private $namespaceManipulators;

    /**
     *
     */
    public function __construct()
    {
        $this->namespaceManipulators = [];
    }

    /**
     * @param NamespaceManipulator $namespaceManipulator
     */
    public function addNamespaceManipulator(NamespaceManipulator $namespaceManipulator)
    {
        $this->namespaceManipulators[] = $namespaceManipulator;
    }

    public function beforeTraverse(array $nodes)
    {
    }

    public function enterNode(Node $node)
    {
        foreach ($this->namespaceManipulators as $manipulator) {
            if ($manipulator->supports($node)) {
                $node = $manipulator->manipulate($node);
            }
        }

        return $node;
    }

    public function leaveNode(Node $node)
    {
    }

    public function afterTraverse(array $nodes)
    {
    }
}
