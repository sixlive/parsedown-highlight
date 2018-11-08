---
extends: _layouts/master
section: body
---

```php
<?php

use sixlive\ParsedownHighlight;
use Mni\FrontYAML\Markdown\MarkdownParser;

class Parser extends ParsedownHighlight implements MarkdownParser
{
    //
}
```