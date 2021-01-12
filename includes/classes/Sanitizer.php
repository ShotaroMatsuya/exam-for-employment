<?php
class Sanitizer
{
    public static function sanitizeString($inputText)
    {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        return $inputText;
    }
    public static function sanitizeArray($array)
    {
        $newArray = array();
        foreach ($array as $el) {
            $el = strip_tags($el);
            $el = str_replace(" ", "", $el);
            array_push($newArray, $el);
        }
        return $newArray;
    }
}
