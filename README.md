# Parsedown Highlight

## *NOTE: This requires v1.8 of Parsedown, which has not been released yet.*

[![Packagist Version](https://img.shields.io/packagist/v/sixlive/parsedown-highlight.svg?style=flat-square)](https://packagist.org/packages/sixlive/parsedown-highlight)
[![Packagist Downloads](https://img.shields.io/packagist/dt/sixlive/parsedown-highlight.svg?style=flat-square)](https://packagist.org/packages/sixlive/parsedown-highlight)
[![Travis](https://img.shields.io/travis/sixlive/parsedown-highlight.svg?style=flat-square)](https://travis-ci.org/sixlive/parsedown-highlight)
[![Code Quality](https://img.shields.io/scrutinizer/g/sixlive/parsedown-highlight.svg?style=flat-square)](https://scrutinizer-ci.com/g/sixlive/parsedown-highlight/)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/sixlive/parsedown-highlight.svg?style=flat-square)](https://scrutinizer-ci.com/g/sixlive/parsedown-highlight/)
[![StyleCI](https://github.styleci.io/repos/156398051/shield)](https://github.styleci.io/repos/156398051)

This extends Parsedown to add support for server side code block rendering. This uses [scrivo/highlight.php](https://github.com/scrivo/highlight.php) to do all the code block rendering. This will be fully compatible with Highlight JS.

## Installation
You can install the package via composer:

```bash
> composer require sixlive/parsedown-highlight
```

## Usage

```md
# Hello!

Here is a post with some code in it.

\```php
<?php

echo 'foo';
\```

\```asldfh
put 'WHOOP!'
\```
```

```php
$parsedown = new \sixlive\ParsedownHighlight;

$parsedown->text(file_get_contents(__DIR__.'/README.md'));
```

```html
<h1>Hello!</h1>
<p>Here is a post with some code in it.</p>
<pre><code class="language-php hljs php"><span class="hljs-meta">&lt;?php</span>

<span class="hljs-keyword">echo</span> <span class="hljs-string">'foo'</span>;</code></pre>
<pre><code class="language-asldfh">put 'WHOOP!'</code></pre>
```

## Testing

``` bash
> composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Code Style
In addition to the php-cs-fixer rules, StyleCI will apply the [Laravel preset](https://docs.styleci.io/presets#laravel).

### Linting
```bash
> composer styles:lint
```

### Fixing
```bash
> composer styles:fix
```

## Security

If you discover any security related issues, please email oss@tjmiller.co instead of using the issue tracker.

## Credits

- [TJ Miller](https://github.com/sixlive)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
