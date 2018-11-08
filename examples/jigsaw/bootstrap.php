<?php

use TightenCo\Jigsaw\Jigsaw;
use Mni\FrontYAML\Markdown\MarkdownParser;

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/Parser.php';

/* @var $container \Illuminate\Container\Container */
/* @var $events \TightenCo\Jigsaw\Events\EventBus */

$container->bind(MarkdownParser::class, Parser::class);

/*
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */
