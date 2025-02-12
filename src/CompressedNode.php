<?php

namespace Amol\Trie;

final class CompressedNode
{
    public static int $nodeCount = 0;

    public function __construct(
        /** @var array<string, CompressedNode> $children */
        public array $children = [],
        public string $label = '',
        public bool $isEnd = false,
    ) {
        static::$nodeCount++;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $children = [];

        foreach ($this->children as $char => $node) {
            $children[$char] = $node->toArray();
        }

        return [
            "is_end" => $this->isEnd,
            "label" => $this->label,
            "children" => $children,
        ];
    }

    public function toJSON(int $flags = 0, int $depth = 512): string|false
    {
        return json_encode($this->toArray(), $flags, max(1, $depth));
    }
}
