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
```bash
cd trie-php
```

Install dependencies
```bash
composer install
```

## Docker Support
To build or start container
```bash
docker compose up -d
```

Get into container then run command like `composer test`
```bash
docker exec -it strfish-php sh
```

To stop container
```bash
docker compose down
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
