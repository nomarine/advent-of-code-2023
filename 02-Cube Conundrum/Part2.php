<?php
    /* $document = file_get_contents('games.txt'); */
    $document = file_get_contents('poc.txt');
    $dataset = explode("\n", $document);
    $cube_colors = ['red', 'blue', 'green'];
    $result = 0;
    $games = setGames($dataset, $cube_colors);

    $cube_limits = setCubeLimits($cube_colors, $games);
    foreach($cube_limits as $game_number=>$game){
        echo 'Game '.$game_number." could have been played with a minimum of:\n";
        foreach($game as $color => $min){
            echo $min.' '.$color." cubes \n";
        }
        echo "\n";
    }
    $power = getPower($cube_limits, $cube_colors);
    echo $power;

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

    function setCubeLimits($cube_colors, $games){
        foreach($games as $game_number => $game){
            $cube_limits[$game_number] = [];
            foreach($cube_colors as $color){
                $cube_limits[$game_number][$color] = max($game[$color]);
            }
        }
        return $cube_limits;
    }

    function getPower($cube_limits, $cube_colors){
        $powers = [];
        foreach($cube_limits as $game_number => $game){
            $power = 1;
            foreach($cube_colors as $color){
                $power *= $game[$color];
            }
            $powers[$game_number] = $power;
        }
        return array_sum($powers);
    }
    
?>