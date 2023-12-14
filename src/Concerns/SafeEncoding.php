<?php

namespace Digiti\GoogleShoppingFeed\Concerns;

trait SafeEncoding{
    /**
     * @param string $string
     * @return string
     */
    public function safeCharEncodeURL($string)
    {
        return str_replace(
            array('%', '[', ']', '{', '}', '|', ' ', '"', '<', '>', '#', '\\', '^', '~', '`'),
            array('%25', '%5b', '%5d', '%7b', '%7d', '%7c', '%20', '%22', '%3c', '%3e', '%23', '%5c', '%5e', '%7e', '%60'),
        $string);
    }

    /**
     * @param string $string
     * @return string
     */
    public function safeCharEncodeText($string)
    {
        return str_replace(
            array('•', '”', '“', '’', '‘', '™', '®', '°', "\n"),
            array('&#8226;', '&#8221;', '&#8220;', '&#8217;', '&#8216;', '&trade;', '&reg;', '&deg;', ''),
        $string);
    }
}
