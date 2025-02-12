<?php

declare(strict_types=1);

namespace Amol\Trie;

class Trie
{
    protected Node $root;

    public function __construct()
    {
        $this->root = new Node();
    }

    public function add(string $str): void
    {
        $str = mb_strtolower($str);
        $node = $this->root;

        $strLen = mb_strlen($str);
        for ($i = 0; $i < $strLen; $i++) {
            $char = $str[$i];

            if (! isset($node->children[$char])) {
                $node->children[$char] = new Node();
            }

            /** @var Node */
            $node = $node->children[$char];
        }

        $node->isEnd = true;
    }

    public function search(string $str): bool
    {
        $str = mb_strtolower($str);
        $cur = $this->root;

        $strLen = mb_strlen($str);
        for ($i = 0; $i < $strLen; $i++) {
            $char = $str[$i];

            if (! isset($cur->children[$char])) {
                return false;
            }

            $cur = $cur->children[$char];
        }

        return $cur->isEnd;
    }

    /** @return string[] $list */
    public function autocomplete(string $str, ?Node $node = null, string $curString = ""): array
    {
        $str = mb_strtolower($str);
        $cur = $node ?? $this->root;

        $list = [];

        $strLen = mb_strlen($str);
        for ($i = 0; $i < $strLen; $i++) {
            $char = $str[$i];
            $curString .= $char;

            if (! isset($cur->children[$char])) {
                return $list;
            }

            $cur = $cur->children[$char];
        }

        if ($cur->isEnd) {
            $list[] = $curString;
        }

        foreach ($cur->children as $char => $node) {
            $local = $curString . $char;
            $arr = $this->autocomplete("", $node, $local);
            $list = array_merge($list, $arr);
        }

        return $list;
    }

    public function toJSON(): string|false
    {
        return $this->root->toJSON();
    }
}
