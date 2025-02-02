<?php

namespace Amol\Trie\Benchmarks;

use Amol\Trie\Trie;

class SearchBench
{
    public $trie;

    public function setUp()
    {
        $trie = new Trie();

        for ($i = 0; $i < 1000; $i++) {
            $trie->add(Helper::generateWord('h', 5));
            $trie->add(Helper::generateWord('hell', 2));
            $trie->add(Helper::generateWord('hello', 2));
        }

        $trie->add('hello');

        $this->trie = $trie;
    }




    /**
     * @BeforeMethods("setUp")
     * @Revs(10)
     * @Iterations(5)
     */
    public function benchSearch()
    {
        $this->trie->search('hello');
    }

    /**
     * @BeforeMethods("setUp")
     * @Revs(10)
     * @Iterations(5)
     */
    public function benchNotSearch()
    {
        $this->trie->search('not-found');
    }
}
