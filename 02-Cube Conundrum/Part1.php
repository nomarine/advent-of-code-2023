<?php
    $document = file_get_contents('games.txt');
    $dataset = explode("\n", $document);
    $cube_colors = ['red', 'blue', 'green'];
    $result = 0;
    $games = setGames($dataset, $cube_colors);
    print_r($games);

    function setGames($dataset, $cube_colors){
        foreach($dataset as $line){
            $pattern = '/game.(\d+)/i';
            preg_match($pattern, $line, $matches);
            
            $index = $matches[1];
            $games[$index] = [];
            
            setCubes($cube_colors, $games[$index], $line);
        }
        return $games;
    }

    function setCubes($cube_colors, &$game, $line){
        foreach($cube_colors as $color){            
            $pattern = '/(\d+).'.$color.'/i';
            preg_match_all($pattern, $line, $matches);
            
            if(!empty($matches[0])){
                foreach($matches[1] as $quantity){
                    $game[$color][] = $quantity;
                }
            }
        }
    }
    
?>