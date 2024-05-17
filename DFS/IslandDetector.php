<?php

/**
 * rows * columns
 * 0->water,1->land
*/
function numIslands($landDetector)
{
    $landDetector = 1;
    $grid = [
        ["1","1","1","1","0"],
        ["1","1","0","1","0"],
        ["1","1","0","0","0"],
        ["0","0","0","0","0"]
    ];


    for($i=0; $i < count($grid); $i++) # rows
    {
        $columns = $grid[$i];
        for($j=0; $j < count($columns); $j++) # columns
        {
            $currentValue = $columns[$j];
            if($currentValue == $landDetector){
                adjacentLands($i,$j, $grid, $columns, $currentValue);
            }
        }
    }
}


function adjacentLands($indexOfRow,$positionOfColumn, $grid, $columnLands, $currentValue)
{
    $traverse = true;
    $startingPositionOfLand = 0;
    $traversed_array = []; 
    $IndexedVisited = [];
    $visited = [];
    $stack = [];
    $top = ''; 
    $btm = ''; 
    $left =''; 
    $right='';

    if($traverse)
    {
        $IndexedVisited[$indexOfRow.','.$positionOfColumn] = $currentValue;
        array_push($visited, $currentValue);
        $traversed_array[$indexOfRow.','.$positionOfColumn] = $currentValue;
        if($positionOfColumn == $startingPositionOfLand)
        {
            $right_position = ($indexOfRow).','.$positionOfColumn+1;
            $btm_position = ($indexOfRow+1) .','.($positionOfColumn);
            $right = $columnLands[$positionOfColumn+1];
            $btm = $grid[$indexOfRow+1][$positionOfColumn];

            if($right == 1)
            {
                $stack[$right_position] = $right;
            }
            if($btm == 1)
            {
                $stack[$btm_position] = $btm;
            }
            
        }else{

        }
    }

}

numIslands(1);
?>