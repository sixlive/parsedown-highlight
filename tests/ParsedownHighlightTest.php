<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use sixlive\ParsedownHighlight;

class ParsedownHighlightTest extends TestCase
{
    /** @test */
    public function code_is_rendered()
    {
        $parsedown = new ParsedownHighlight;

        $renderedMarkdown = $parsedown->text(file_get_contents(__DIR__.'/Support/test.md'));

        $this->assertContains("<pre><code class=\"language-php hljs php\"><span class=\"hljs-meta\">&lt;?php</span>\n\n<span class=\"hljs-keyword\">echo</span> <span class=\"hljs-string\">'foo'</span>;</code></pre>", $renderedMarkdown);
    }

    /** @test */
    public function language_errors_are_swallowd()
    {
        $parsedown = new ParsedownHighlight;

        $renderedMarkdown = $parsedown->text(file_get_contents(__DIR__.'/Support/test.md'));

        $this->assertContains("<pre><code class=\"language-asldfh\">put 'WHOOP!'</code></pre>", $renderedMarkdown);
    }

    /** @test */
    public function code_is_highlighted_with_single_numbers()
    {
        $parsedown = new ParsedownHighlight;
        $markdown = <<<'MD'
```plaintext{1,3}
hello

world
```
MD;
        $renderedMarkdown = $parsedown->text($markdown);
        $expected = <<<'HTML'
<pre><code class="language-plaintext hljs plaintext"><span class="loc highlighted">hello</span>
<span class="loc"></span>
<span class="loc highlighted">world</span></code></pre>
HTML;

        $this->assertEquals($expected, $renderedMarkdown);
    }

    /** @test */
    public function code_is_highlighted_with_a_range()
    {
        $parsedown = new ParsedownHighlight;
        $markdown = <<<'MD'
```plaintext{1-3}
hello

world
```
MD;
        $renderedMarkdown = $parsedown->text($markdown);
        $expected = <<<'HTML'
<pre><code class="language-plaintext hljs plaintext"><span class="loc highlighted">hello</span>
<span class="loc highlighted"></span>
<span class="loc highlighted">world</span></code></pre>
HTML;

        $this->assertEquals($expected, $renderedMarkdown);
    }

    /** @test */
    public function code_is_highlighted_with_single_digits_and_range()
    {
        $parsedown = new ParsedownHighlight;
        $markdown = <<<'MD'
```plaintext{1,4-6}
hello

world
highlight me
and also me
...
```
MD;
        $renderedMarkdown = $parsedown->text($markdown);
        $expected = <<<'HTML'
<pre><code class="language-plaintext hljs plaintext"><span class="loc highlighted">hello</span>
<span class="loc"></span>
<span class="loc">world</span>
<span class="loc highlighted">highlight me</span>
<span class="loc highlighted">and also me</span>
<span class="loc highlighted">...</span></code></pre>
HTML;

        $this->assertEquals($expected, $renderedMarkdown);
    }
}
