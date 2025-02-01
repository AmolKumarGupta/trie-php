<?php

$finder = (new PhpCsFixer\Finder())
  ->in([
    __DIR__ . '/src',
    __DIR__ . '/tests',
  ]);

return (new PhpCsFixer\Config())
  ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
  ->setFinder($finder)
;
