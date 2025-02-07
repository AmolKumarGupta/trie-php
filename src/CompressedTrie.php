<?php

declare(strict_types=1);

namespace Amol\Trie;

class CompressedTrie
{
    protected CompressedNode $root;

    public function __construct()
    {
        $this->root = new CompressedNode();
    }

    public function add(string $str): void
    {
        $str = mb_strtolower($str);
        $strLength = mb_strlen($str);
        $node = $this->root;
        $i = 0;

        while ($i < $strLength) {
            $char = $str[$i];

            $child = $node->children[$char] ?? null;
            if (! $child) {
                $newNode = new CompressedNode(label: substr($str, $i + 1), isEnd: true);
                $node->children[$char] = $newNode;
                break;
            }

            $node = $child;
            $prefixLen = $this->commonPrefix(substr($str, $i + 1), $node->label);
            $i += ($prefixLen + 1);

            if ($prefixLen < mb_strlen($node->label)) {
                $newChar = $node->label[$prefixLen];

                $newNode = new CompressedNode(
                    children: $node->children,
                    label: mb_substr($node->label, $i),
                    isEnd: $node->isEnd
                );

                $node->label = mb_substr($node->label, 0, $prefixLen);
                $node->isEnd = $i === $strLength;
                $node->children = [];
                $node->children[$newChar] = $newNode;
            }
        }
    }

    private function commonPrefix(string $a, string $b): int
    {
        $len = 0;

        $aLength = mb_strlen($a);
        $bLength = mb_strlen($b);

        while ($len < $aLength && $len < $bLength && $a[$len] === $b[$len]) {
            $len++;
        }

        return $len;
    }

    public function search(string $str): bool
    {
        $str = mb_strtolower($str);
        $cur = $this->root;

        for ($i = 0; $i < mb_strlen($str); $i++) {
            $char = $str[$i];

            if (! isset($cur->children[$char])) {
                return false;
            }

            $cur = $cur->children[$char];
        }

        return $cur->isEnd;
    }

    /** @return string[] $list */
    public function autocomplete(string $str, ?CompressedNode $node = null, string $curString = ""): array
    {
        $str = mb_strtolower($str);
        $cur = $node ?? $this->root;

        $list = [];

        for ($i = 0; $i < mb_strlen($str); $i++) {
            $char = $str[$i];
            $curString .= $char;

            if (! isset($cur->children[$char])) {
                return $list;
            }

            /** @var CompressedNode $cur */
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

    public function toJSON(int $flags = 0, int $depth = 512): string|false
    {
        return $this->root->toJSON($flags, max(0, $depth));
    }
}
