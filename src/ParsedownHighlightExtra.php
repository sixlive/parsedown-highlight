<?php

namespace sixlive;

use ParsedownExtra;
use DomainException;
use Highlight\Highlighter;

class ParsedownHighlightExtra extends ParsedownExtra
{
    protected $highlighter;

    public function __construct()
    {
        $this->highlighter = new Highlighter;
    }

    protected function blockFencedCodeComplete($block)
    {
        if (! isset($block['element']['element']['attributes'])) {
            return $block;
        }

        $code = $block['element']['element']['text'];
        $languageClass = $block['element']['element']['attributes']['class'];
        $language = explode('-', $languageClass);

        try {
            $highlighted = $this->highlighter->highlight($language[1], $code);
            $block['element']['element']['attributes']['class'] = vsprintf('%s hljs %s', [
                $languageClass,
                $highlighted->language,
            ]);
            $block['element']['element']['rawHtml'] = $highlighted->value;
            unset($block['element']['element']['text']);
        } catch (DomainException $e) {
            //
        }

        return $block;
    }
}
