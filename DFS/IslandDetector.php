<?php
// $IndexedVisited = [];
// $visited = [];
// $stack = [];

/**
 * rows * columns
 * 0->water,1->land
*/
function numIslands($landDetector)
{
    $landDetector = 1;
    $grid =[
        ["1","1","0","0","0"],
        ["1","1","0","0","0"],
        ["0","0","1","0","0"],
        ["0","0","0","1","1"]
    ];

    $links = 0;
    $IndexedVisited =[]; $visited=[]; $stack=[];
    
    for($i=0; $i < count($grid); $i++) # rows
    {
        $columns = $grid[$i];
        for($j=0; $j < count($columns); $j++) # columns
        {
            $currentValue = $columns[$j];
            if($currentValue == $landDetector){
                $currentPositionOfItem = $i.','.$j;
                if(!array_key_exists($currentPositionOfItem,$IndexedVisited)){
                    $links++;
                    adjacentLands($i, $j, $grid, $columns, $currentValue ,$IndexedVisited,  $visited, $stack);
                }
            }
        }
    }
    return $links;
}



function adjacentLands($indexOfRow, $positionOfColumn, $grid, $columnLands, $currentValue, &$IndexedVisited, &$visited, &$stack)
{
    $top = '';
    $btm = ''; 
    $left = '';
    $right = '';
    
    if(!array_key_exists($IndexedVisited[$indexOfRow.','.$positionOfColumn] , $IndexedVisited))
    {
        $IndexedVisited[$indexOfRow.','.$positionOfColumn] = $currentValue; ## what are the indexes visited (optimization)

        $visited[$indexOfRow.','.$positionOfColumn] = $currentValue;

        $next_index = $positionOfColumn+1;
        $right_position = ($indexOfRow).','.$next_index; # right-side position
        $btm_position = ($indexOfRow+1) .','.($positionOfColumn);# btm position
        
        $right = (isset($columnLands[$next_index])) ? $columnLands[$next_index] : 0;
        $btm = (isset($grid[$indexOfRow+1][$positionOfColumn])) ? $grid[$indexOfRow+1][$positionOfColumn] : 0;

        if( $positionOfColumn != 0 )
        {
            $left_side = ($positionOfColumn-1);
            $left_position = ($indexOfRow).','.$left_side;
            if(!array_key_exists($left_position,$visited))
                $left = $grid[$indexOfRow][$positionOfColumn-1];

            $top_position = ($indexOfRow - 1).','.$positionOfColumn;
            if(!array_key_exists($top_position,$visited))
                $top = $grid[$indexOfRow-1][$positionOfColumn];

        }

        if( $right == 1 && !array_key_exists($right_position,$visited) )
            $stack[$right_position] = $right;
        if( $btm == 1 && !array_key_exists($btm_position,$visited) )
            $stack[$btm_position] = $btm;
        if( $left == 1 )
            $stack[$left_position] = $left;
        if( $top == 1)
            $stack[$top_position] = $top;

        if(!empty($stack))
            dfs($visited, $stack, $IndexedVisited, $grid); ## recursive
    }
}

function dfs($visited, $stack, &$IndexedVisited, $grid)
{
    foreach($stack as $key => $item)
    {
        $rawData = explode(",",$key);
        $indexOfRow = $rawData[0];
        $positionOfColumn = $rawData[1];
        $columnLands = $grid[$indexOfRow];
        $IndexedVisited[$indexOfRow.','.$positionOfColumn] = $item; ## $item is 1
        unset($stack[$key]);
        adjacentLands($indexOfRow, $positionOfColumn, $grid, $columnLands, $item, $IndexedVisited, $visited, $stack);
    }
}

numIslands(1);
?>