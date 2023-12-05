<?php
    $document = file_get_contents('calibration-doc.txt');
    $lines = explode("\n", $document);
    $digits = [
        'one' => 1,
        'two' => 2,
        'three' => 3,
        'four' => 4,
        'five' => 5,
        'six' => 6,
        'seven' => 7,
        'eight' => 8,
        'nine' => 9
    ];
    $result = 0;
    createCalcMemory();
    $digit_list = implode('|', array_map('preg_quote', array_keys($digits)));

     foreach($lines as $line){
        updateCalcMemory("\n");
        updateCalcMemory($line."\n");
        $matches = searchDigits($line, $digit_list);
        if(!empty($matches[1])){
            $number = setNumber($matches, $digits);
            $result += $number;
            updateCalcMemory($matches[1][0] . end($matches[1]) . " = " . $result . "\n");
            updateCalcMemory($number . " = " . $result . "\n");
        }
    } 

    function searchDigits($line, $digit_list){
        preg_match_all('/(?=(\d|'. $digit_list . '))/', $line, $matches);
        return $matches;
    }
    
    function setNumber($matches, $digits){
        $first_digit = is_numeric($matches[1][0]) ? $matches[1][0] : $digits[$matches[1][0]];
        $last_digit = is_numeric(end($matches[1])) ? end($matches[1]) : $digits[end($matches[1])];
        $number = $first_digit . $last_digit;
        return $number;
    }

    function createCalcMemory(){
        $filename = 'calc_memory.txt';
        file_put_contents($filename, '');
    }

    function updateCalcMemory($content){
        $filename = 'calc_memory.txt';
        file_put_contents($filename, $content, FILE_APPEND);
    }
?>