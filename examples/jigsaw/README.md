# Jigsaw Example

## Setup
```bash
> composer install
> jigsaw build
> jigsaw serve
```

After setup, pop open a browser and visit the URL that jigsaw is served at `/test-post`.

## Walkthrough

To add Parsedown highlight there are a few manual steps (for now) that need to be done to get it configured.

### 1) Add the library

```bash
> composer require sixlive/parsedown-highlight
```

### 2) Create Parser.php
Jigsaw binds the markdown parser using the `Mni\FrontYAML\Markdown\MarkdownParser` contract. Parsedown does have the methods to satisfy the contract but does not physically implement it so we need to create a class that implements the contract.

```php
<?php

use sixlive\ParsedownHighlight;
use Mni\FrontYAML\Markdown\MarkdownParser;

class Parser extends ParsedownHighlight implements MarkdownParser
{
    //
}
```

### 3) Bind the parser to Jigsaw
The last thing we need to do is add the autoloader, our parser class, and add the binding for the parser class to the contract we mentioned in the previous step.

`bootstrap.php`
```php
use TightenCo\Jigsaw\Jigsaw;
use Mni\FrontYAML\Markdown\MarkdownParser;

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/Parser.php';

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */

$container->bind(MarkdownParser::class, Parser::class);
```
