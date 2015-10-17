<?php

namespace Webmozart\PhpScoper\Finder;

use Symfony\Component\Finder\Finder;

class SymfonyPhpFileFinder implements PhpFileFinder
{
    /**
     * @var Finder
     */
    private $finder;

    /**
     * @param Finder $finder
     */
    public function __construct(Finder $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param string $directory
     * @return \Iterator
     */
    public function findFiles($directory)
    {
        return $this->finder->in($directory)->name('*.php')->getIterator();
    }
}