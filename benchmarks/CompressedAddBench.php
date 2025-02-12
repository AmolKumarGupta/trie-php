<?php

namespace Amol\Trie\Benchmarks;

use Amol\Trie\CompressedTrie;

class CompressedAddBench
{
    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchAdd()
    {
        $trie = new CompressedTrie();
        $trie->add('hello');
    }

    /**
     * @Revs(100)
     * @Iterations(5)
     * @ParamProviders("getWord")
     */
    public function benchAdd1000(array $params)
    {
        $trie = new CompressedTrie();

        foreach ($params as $d) {
            $trie->add($d);
        }
    }

    public function getWord()
    {
        $data = [];
        for ($i = 0; $i < 1000; $i++) {
            $data[] = Helper::generateWord('app', 2);
            $data[] = Helper::generateWord('hello', 2);
        }

        yield $data;
    }
}
