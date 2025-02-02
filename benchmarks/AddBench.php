<?php

namespace Amol\Trie\Benchmarks;

use Amol\Trie\Trie;

class AddBench
{
    /**
     * @Revs(1000)
     * @Iterations(5)
     */
    public function benchAdd()
    {
        $trie = new Trie();
        $trie->add('hello');
    }

    /**
     * @Revs(100)
     * @Iterations(5)
     * @ParamProviders("getWord")
     */
    public function benchAdd1000(array $params)
    {
        $trie = new Trie();

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
