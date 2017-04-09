<?php

/**
 * The text is getting sent by the web-form with paired braces of 3 kinds: (), [], {}.
 * There could be any amount of braces even 0, but the braces always must be paired.
 * Define the level of nesting. Nesting is getting defined by outputting the text between braces including them. Each braces area should be outputted on a separate string.
 * Braces areas can cross each other.
 */

require_once 'header.html';

if (isset($_REQUEST['Open'])) {
    $items = array();
    $text = htmlspecialchars($_REQUEST['text']);
    if (preg_match_all('/\\(([^(]*?)\\)/isx', $text, $matches, PREG_OFFSET_CAPTURE)) {
        foreach ($matches[0] as $full_match) {
            $items[$full_match[1]] = $full_match[0];
        }
    }
    if (preg_match_all('/\\[([^[]*?)\\]/isx', $text, $matches, PREG_OFFSET_CAPTURE)) {
        foreach ($matches[0] as $full_match) {
            $items[$full_match[1]] = $full_match[0];
        }
    }
    if (preg_match_all('/\\{([^{]*?)\\}/isx', $text, $matches, PREG_OFFSET_CAPTURE)) {
        foreach ($matches[0] as $full_match) {
            $items[$full_match[1]] = $full_match[0];
        }
    }
    ksort($items);
}


require_once 'footer.html';
