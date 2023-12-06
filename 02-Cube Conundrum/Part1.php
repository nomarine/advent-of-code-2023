<?php
    include('./game-settings.php');
    $document = file_get_contents('games.txt');
    $dataset = explode("\n", $document);
    $cube_colors = ['red', 'blue', 'green'];
    $result = 0;
    $games = setGames($dataset, $cube_colors);
    /* print_r($games); */
    $possible_games = checkPossibleGame($cube_quantity, $cube_colors, $games);
    print_r(getResult($possible_games));

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

    function checkPossibleGame($cube_quantity, $cube_colors, $games){
        foreach($games as $game_number => $game){
            $isPossible = true;
            foreach($cube_colors as $color){
                foreach($game[$color] as $quantity){
                    if($quantity > $cube_quantity[$color]){
                        echo 'Game '. $game_number . ' not possible. '.$quantity. ' ' .$color.' cubes higher than what was set.' . "\n";
                        $isPossible = false;
                    }
                }
            }
            if($isPossible){
                $possible_games[] = $game_number;
            }
            
        }
        print_r($possible_games);
        return $possible_games;
    }

    function getResult($game_numbers){
        $result = 0;
        foreach($game_numbers as $number){
            $result += $number;
        }
        return $result;
    }
    
?>