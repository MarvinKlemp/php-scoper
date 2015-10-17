<?php

namespace Webmozart\PhpScoper\Finder;

interface PhpFileFinder
{
    /**
     * @param string $directory
     *
     * @return \Iterator
     */
    public function findFiles($directory);
}
