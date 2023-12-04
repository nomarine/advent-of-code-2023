<?php
    $document = file_get_contents('calibration-doc.txt');
    $lines = explode("\n", $document);
    $result = 0;

    foreach($lines as $line){
        preg_match_all('/\d/', $line, $matches);
        $result += $matches[0][0] . end($matches[0]);
        print_r($matches[0][0] . end($matches[0]) . " = " . $result . "\n");
    }
?>