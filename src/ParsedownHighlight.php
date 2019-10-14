<?php

namespace sixlive;

use Parsedown;
use DomainException;
use Highlight\Highlighter;
use function HighlightUtilities\splitCodeIntoArray;

class ParsedownHighlight extends Parsedown
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
        $blockClass = $block['element']['element']['attributes']['class']; // language-php{1,4-5}
        $infoString = $this->parseInfoString($blockClass);
        $language = $infoString['language'];

        try {
            $highlighted = $this->highlighter->highlight($language, $code);
            $highlightedCode = $highlighted->value;

            if (! empty($infoString['lines'])) {
                $loc = splitCodeIntoArray($highlightedCode);

                foreach ($loc as $i => &$line) {
                    $line = vsprintf('<span class="loc%s">%s</span>', [
                        isset($infoString['lines'][$i + 1]) ? ' highlighted' : '',
                        $line,
                    ]);
                }

                $highlightedCode = implode("\n", $loc);
            }

            $block['element']['element']['attributes']['class'] = vsprintf('language-%s hljs %s', [
                $highlighted->language,
                $highlighted->language,
            ]);
            $block['element']['element']['rawHtml'] = $highlightedCode;
            unset($block['element']['element']['text']);
        } catch (DomainException $e) {
            //
        }

        return $block;
    }

    private function parseInfoString($languageClass)
    {
        $infoString = [
            'language' => '',
            'lines' => [],
        ];

        // The length of the following prefix attached by Parsedown: `language-`
        $prefixLength = 9;

        if (($bracePos = strpos($languageClass, '{'))) {
            $infoString['language'] = substr($languageClass, $prefixLength, $bracePos - $prefixLength);

            $rawLineDef = substr($languageClass, $bracePos + 1, -1);
            $lineDefs = explode(',', $rawLineDef);

            foreach ($lineDefs as $lineDef) {
                if (($hyphenPos = strpos($lineDef, '-')) !== false) {
                    $start = intval(substr($lineDef, 0, $hyphenPos));
                    $end = intval(substr($lineDef, $hyphenPos + 1));

                    for ($i = $start; $i <= $end; $i++) {
                        $infoString['lines'][$i] = true;
                    }
                } else {
                    $infoString['lines'][intval($lineDef)] = true;
                }
            }
        } else {
            $infoString['language'] = substr($languageClass, $prefixLength);
        }

        return $infoString;
    }
}
