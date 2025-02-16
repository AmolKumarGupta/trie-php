## Trie Implementation

Trie is a tree data structure which is used to store, search and retrieve strings, It is used for autocomplete

## Feature
 - Two Type: Trie and Compressed Trie
 - Search existence
 - Autocomplete words


## Quick start

```php
use Amol\Trie\CompressedTrie;

$trie = new CompressedTrie();

$trie->add('hello');
$trie->add('apple');

$trie->search('apple'); // true
$trie->autocomplete('app'); // [apple]
```


## Installation

Clone the repository
```bash
git clone https://github.com/AmolKumarGupta/trie-php.git
```

Install dependencies
```bash
composer install
```

## For Contributors

### Testing and Linting
```bash
composer lint && composer test
```

### Benchmarks
```bash
composer bench
```
