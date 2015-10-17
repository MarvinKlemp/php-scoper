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

use Symfony\Component\Finder\Finder;
use Webmozart\Console\Api\Args\Args;
use Webmozart\Console\Api\IO\IO;
use Webmozart\PhpScoper\Finder\SymfonyPhpFileFinder;
use Webmozart\PhpScoper\Parser\Parser;

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

        // search all $paths, add $prefix to all namespace declarations, use

        $finder = new Finder();
        $finder = new SymfonyPhpFileFinder($finder);

        $files = $finder->findFiles($paths);
        $parser = new Parser($files);

        foreach ($files as $file) {
            $parser->parseFile($file);
        }

        // statements and class usages with fully-qualified class names

        $io->writeLine('...');

        return 0;
    }
}
