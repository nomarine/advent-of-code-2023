<?php
    $document = file_get_contents('poc.txt');
    $lines = explode("\n", $document);
    $schematics = generateSchematic($lines);
    
    /* print_r($schematics); */
    generateMatrix($schematics, $numerics, $specials);

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

    function getPartNumbers($matrix){
        foreach($matrix[0] as $line_position => $line){
            foreach($line as $char_position => $char){
                if($line_position > 0){
                    for($i = $line_position-1; $i < $line_position+1; $i++){
                        if($char_position > 0){
                            for($j = $char_position-1; $j < $char_position+1; $j++){
                                if($matrix[$line_position-1][$i]);
                    }
                }
            }
        }}
        }
    }

    function checkSurroundings($matrix, $line, $char){
        if($line === reset($matrix)){
            for($i = key($line); $i <= key($line)+1; $i++){
                foreach($line as $key => $value){

                }
            }
        }
    }

    function is_special($char){
        return ctype_punct($char) && $char != '.';
    }
?>