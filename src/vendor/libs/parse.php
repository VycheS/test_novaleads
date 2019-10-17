<?php
function parse(string $text, string $first, string $last, bool $recursion = false)
{
    $pos = strpos($text, $first);
    if ($pos !== false) {
        $subText = substr($text, $pos - 1);
        //return strip_tags(substr($subText, 0, strpos($subText, $last)));
        return substr($subText, 0, strpos($subText, $last) + strlen($last));
    } else return false;
}
