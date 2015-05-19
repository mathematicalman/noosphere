<?php

ini_set('error_reporting', E_ALL);

function fileTextSearch($filePattern, $isTextSearchOn, $textPattern) {
    $files = array_filter(glob($filePattern), "is_file");
    if (!$isTextSearchOn)
        return $files;
    $textPattern = preg_quote($textPattern);
    $textPattern = str_replace('\?', '\S', $textPattern);
    $textPattern = str_replace('\*', '\S*', $textPattern);
    $textPattern = str_replace('/', '\/', $textPattern);
    $textPattern = '/[^A-Za-z0-9]' . $textPattern . '[^A-Za-z0-9]/i';
    $words = array();
    foreach ($files as $value) {
        $file = file_get_contents($value);
        preg_match_all($textPattern, $file, $matches);
        foreach ($matches as $matchesArray) {
            foreach ($matchesArray as $matchesValue)
                $words[] = "$value: " . $matchesValue;
        }
    }
    return $words;
}

$result = fileTextSearch($_GET["fileName"], $_GET["textSearchCheckbox"], $_GET["textSearch"]);
foreach ($result as $value) {
    echo "$value" . "<br/>";
}