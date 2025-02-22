<?php

use Amol\Trie\CompressedTrie;

it('add two words and search one of them', function () {
    $trie = new CompressedTrie();

    $trie->add('hello');
    $trie->add('apple');

    expect($trie->search('apple'))->toBeTrue();
    expect($trie->search('hello'))->toBeTrue();
});

it('add and search a number', function () {
    $trie = new CompressedTrie();
    // number will be cast to string
    $trie->add(2);
    expect($trie->search(2))->toBeTrue();
});

it('add words and get autocomplete suggestions', function () {
    $trie = new CompressedTrie();

    $trie->add('hello');
    $trie->add('apple');
    $trie->add('app');
    $trie->add('apples');
    $trie->add('banana');

    expect($trie->autocomplete('app'))->toBe(['app', 'apple', 'apples']);
    expect($trie->autocomplete('appl'))->toBe(['apple', 'apples']);
    expect($trie->autocomplete('apple'))->toBe(['apple', 'apples']);
    expect($trie->autocomplete('apples'))->toBe(['apples']);
    expect($trie->autocomplete('a'))->toBe(['app', 'apple', 'apples']);

    expect($trie->autocomplete('b'))->toBe(['banana']);
    expect($trie->autocomplete('c'))->toBe([]);

    expect($trie->autocomplete('hello'))->toBe(['hello']);
    expect($trie->autocomplete('hell'))->toBe(['hello']);
    expect($trie->autocomplete('hellooo'))->toBe([]);
});
