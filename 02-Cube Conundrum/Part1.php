<?php
    $document = file_get_contents('games.txt');
    $lines = explode("\n", $document);
    $cube_colors = ['red', 'blue', 'green'];
    $result = 0;
    setGames($lines);

    function setGames($dataset){
        $games = [[]];
        foreach($dataset as $line){
            $pattern = '/game.(\d+)/i';
            preg_match($pattern, $line, $matches);
            /* print_r($matches); */
            $index = $matches[1];

            /* print_r($games); */
            setCubes($colors, $game[$index], $line);
        }
    }

    function setCubes($colors, $game, $line){
        foreach($colors as $color){
            $game = [
                $color => []
            ];
        }
        
        $pattern = '/(\d+).green/i';
        preg_match_all($pattern, $line, $matches);
        if(!empty($matches[0])){
            foreach($matches[1] as $quantity){
                /* print_r($quantity."\n"); */
                $game['green'][] = $quantity;
            }
            print_r($game['green']);
        }
    }
    
?>