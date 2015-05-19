<?php

ini_set('error_reporting', E_ALL);

function convert_number_to_words($number) {
    
    $dictionary = array(
        'zero',
        'one',
        'two',
        'three',
        'four',
        'five',
        'six',
        'seven',
        'eight',
        'nine',
        'ten',
        'eleven',
        'twelve',
        'thirteen',
        'fourteen',
        'fifteen',
        'sixteen',
        'seventeen',
        'eighteen',
        'nineteen',
        'twenty',
        30 => 'thirty',
        40 => 'fourty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety',
        100 => 'hundred',
        1000 => 'thousand',
        1000000 => 'million',
        1000000000 => 'billion',
        1000000000000 => 'trillion',
        1000000000000000 => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    
    if (!is_numeric($number))
        return 'Is not a numeric';
    if (strpos($number, 'E'))
        return 'Is out of range';
    if ($number < 0)
        return 'negative ' . convert_number_to_words(abs($number));
    if (strpos($number, '.')) {
        list($number, $fraction) = explode('.', $number);
        $fractionString = " point";
        foreach (str_split($fraction) as $value) 
            $fractionString .= " " . $dictionary[$value];     
        return convert_number_to_words($number) . $fractionString;
    }

    if ($number < 21) {
        $string = $dictionary[$number];
    } else if ($number < 100) {
        $tens = ((int) ($number / 10)) * 10;
        $units = $number % 10;
        $string = $dictionary[$tens];
        if ($units > 0)
            $string .= ' ' . $dictionary[$units];
    } else if ($number < 1000) {
        $hundreds = ((int) ($number / 100));
        $remainder = $number % 100;
        $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
        if ($remainder > 0)
            $string .= ' ' . convert_number_to_words($remainder);
    } else {
        $topUnitsDegree = pow(1000, floor(log($number, 1000)));
        $topUnits = (int) ($number / $topUnitsDegree);
        $remainder = $number % $topUnitsDegree;
        $string = convert_number_to_words($topUnits) . ' ' . $dictionary[$topUnitsDegree];
        if ($remainder > 0)
            $string .= ' ' . convert_number_to_words($remainder);
    }

    return $string;
}

$testArray = array(
    0,
    1,
    12,
    123,
    2345,
    12345,
    -12345,
    -0,
    -1,
    123.345,
    -12.34,
    -0.23,
    0.23,
    123456,
    123000,
    100000,
    300000,
    3000000,
    30000000,
    10304507,
    PHP_INT_MAX,
    9223372036854775808,
    "ksjdhf"
);

foreach ($testArray as $value) {
    echo "$value - " . convert_number_to_words($value) . "<br/>";
}