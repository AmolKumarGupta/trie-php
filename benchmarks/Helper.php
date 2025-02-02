<?php

namespace Amol\Trie\Benchmarks;

class Helper
{
    public static function generateWord($startChar, $length)
    {
        $permitted_chars = 'abcdefghijklmnopqrstuvwxyz';
        $word = $startChar;
        for ($i = 1; $i < $length; $i++) {
            $word .= substr(str_shuffle($permitted_chars), 0, 1);
        }

        return $word;
    }
}
