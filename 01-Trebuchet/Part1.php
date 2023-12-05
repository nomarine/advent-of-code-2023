<?php
    $document = file_get_contents('calibration-doc.txt');
    $lines = explode("\n", $document);
    $result = 0;

    foreach($lines as $line){
        $matches = searchDigits($line);
        if(!empty($matches[0])){
            $number = setNumber($matches);
            $result += $number;
            print_r($matches[0][0] . end($matches[0]) . " = " . $result . "\n");
        }
    }

    function searchDigits($line){
        preg_match_all('/\d/', $line, $matches);
        return $matches;
    }
    
    function setNumber($matches){
        $first_digit = $matches[0][0];
        $last_digit = end($matches[0]);
        return $first_digit . $last_digit;
    }
?>