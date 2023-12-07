<?php
    $document = file_get_contents('poc.txt');
    $lines = explode("\n", $document);
    $schematics = generateSchematic($lines);
    
    /* print_r($schematics); */
    getPartNumbers($schematics);

    function generateSchematic($lines){
        return array_map('str_split', $lines);
    }

    function generateMatrix($schematics, &$numerics, &$specials){
        foreach($schematics as $line){
            $matrix['numerics'][] = array_map('is_numeric', $line);
            $matrix['specials'][] = array_map('is_special', $line);
        }
        return $matrix;
    }

    function getPartNumbers($schematics){
        $part_numbers = "";
        foreach($schematics as $line_position => $line){
            foreach($line as $char_position => $char){
                if(is_numeric($char) && (is_special($line[$char_position+1])) ){
                    $part_numbers .= $char;
                }
            }
        }
        print_r($part_numbers);
        return $part_numbers;
    }

    function is_special($char){
        return ctype_punct($char) && $char != '.';
    }
?>