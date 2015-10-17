<?php

/*
 * This file is part of the webmozart/php-scoper package.
 *
 * (c) Bernhard Schussek <bschussek@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Webmozart\PhpScoper\Handler;

use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use Symfony\Component\Finder\Finder;
use Webmozart\Console\Api\Args\Args;
use Webmozart\Console\Api\IO\IO;
use Webmozart\PhpScoper\Finder\SymfonyPhpFileFinder;
use Webmozart\PhpScoper\NamespaceManipulator\UseStatementManipulator;
use Webmozart\PhpScoper\Parser\Parser;
use Webmozart\PhpScoper\Parser\Visitor;

/**
 * Handles the "add-prefix" command.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class AddPrefixCommandHandler
{
    /**
     * Handles the "add-prefix" command.
     *
     * @param Args $args The console arguments.
     * @param IO   $io   The I/O.
     *
     * @return int Returns 0 on success and a positive integer on error.
     */
    public function handle(Args $args, IO $io)
    {
        $prefix = $args->getArgument('prefix');
        $paths = $args->getArgument('path');

        $finder = new Finder();
        $finder = new SymfonyPhpFileFinder($finder);

        $files = $finder->findFiles($paths);

        $visitor = new Visitor();
        $visitor->addNamespaceManipulator(new UseStatementManipulator($prefix));

        $traverser = new NodeTraverser();
        $traverser->addVisitor(new NameResolver());
        $traverser->addVisitor($visitor);

        $parser = new Parser($traverser);

        foreach ($files as $file) {
            $nodes = $parser->parseFile($file);

            //@TODO dump nodes (only if changes occured)
        }

        // search all $paths, add $prefix to all namespace declarations, use
        // statements and class usages with fully-qualified class names

        $io->writeLine('...');

        return 0;
    }
}
