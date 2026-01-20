<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = (new Finder())
    ->name('*.stub')
    ->in(__DIR__);

return (new Config())
    ->setFinder($finder);
