<?php

namespace Webmozart\PhpScoper\NamespaceManipulator;

use PhpParser\Node;

interface NamespaceManipulator
{
    /**
     * @param Node $node
     *
     * @return bool
     */
    public function supports(Node $node);

    /**
     * @param Node $node
     *
     * @return Node
     */
    public function manipulate(Node $node);
}
