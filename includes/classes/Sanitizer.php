<?php
class Sanitizer
{
    public static function sanitizeString($inputText)
    {
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "", $inputText);
        //全角スペース除去
        $inputText = preg_replace('/\A[\x00\s]++|[\x00\s]++\z/u', '', $inputText);

        return $inputText;
    }
    public static function sanitizeTextArea($inputText)
    {
        $inputText = strip_tags($inputText);
        $inputText = trim($inputText);
        //全角スペース除去
        $inputText = preg_replace('/\A[\x00\s]++|[\x00\s]++\z/u', '', $inputText);
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
