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
}
