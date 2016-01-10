<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            table, td {
                border:1px solid black;
                font-size:large; 
                font-weight:bold;
            }
        </style>
    </head>
    <body>
        <?php
        class Game {
                var $position;
                function Game($squares){
                    $this->position = str_split($squares);
                }
                function __pick_move(){
                    $array = []; //array of all unselected spots, currently empty.
                    $open_space = 0; //counter of all unselected spots.
                    for($i=0; $i<9; $i++){ //loops through the board.
                        if($this->position[$i] == '-'){ //searching for open spots.
                            $array[$open_space] = $i; //keeps track of which position an open spot is.
                            $open_space++;
                        }
                    }
                    $this->position[$array[round(rand(0, $open_space-1))]] = 'x'; //make our move.
                }
                
                function __display(){
                    echo '<table cols="3" cellpadding="5">';
                    echo '<tr>'; // open the first row;
                    for($pos=0; $pos<9; $pos++){
                        echo $this->show_cell($pos);
                        if($pos %3 == 2){ echo '</tr><tr>'; /*start a new row for the next square*/}
                    }
                    echo '</tr>';//close the last row
                    echo '</table>'; //close the table
                }
                function show_cell($which){
                    $token = $this->position[$which];
                    if($token <> '-'){ return '<td>'.$token.'</td>';}
                    $this-> newposition = $this->position; //copy the original.
                    $this-> newposition[$which] = 'o'; //this is their move.
                    $move = implode($this->newposition); //create spring from board.
                    
                    $link = 'http://localhost/ACIT4850Lab1/index.php/?board='.$move;
                    // This is what we want the link to be, return cell with anchor and showing a hyphen.
                    return '<td><a href="'.$link.'">-</a></td>';
                }
                
                function __winner($token){
                    $winner = false;
                    for($row=0; $row<3; $row++){ //checking all rows for possible wins.
                        $result = 0;
                        for($col=0; $col<3; $col++){
                            if($this->position[(3*$row + $col)] == $token) {$result++;}
                            
                        }
                        if($result == 3){$winner = true;}
                    }
                    for($col=0; $col<3; $col++){ //checking all columns for possible wins.
                        $result = 0;
                        for($row=0; $row<3; $row++){
                            if($this->position[($col + 3*$row)] == $token) {$result++;}
                        }
                        if($result == 3){$winner = true;}
                    }
                    //*checking both diagonals for possible wins.
                    if( ($this->position[0] == $token) && 
                        ($this->position[4] == $token) && 
                        ($this->position[8] == $token))
                    { $winner = true; }
                    else if(($this->position[2] == $token) && 
                        ($this->position[4] == $token) && 
                        ($this->position[6] == $token))
                    { $winner = true; }
                return $winner;   
                }
            }
        
        //check if a board parameter was passed
        if(!isset($_GET['board'])){$position = '---------'; /*incase a board has not been created yet*/}
        else {$position = $_GET['board'];}
            $temp = "Anderson";
            echo 'Hi, name is '.$temp.'. ME GO FACE SMOrc SMOrc Kappa'; // trolling here, don't mind this.
            
            $game = new Game($position); //make a new game
            if ($game->__winner('o') == false ){$game->__pick_move();} //checks for if the player won already.
            $game->__display();
            // winner checking.
            if($game->__winner('x') == true ){echo 'Me win, get good noob';}
            else if ($game->__winner('o') == true ){echo 'WINNNNNEEERRR';}
            else {echo 'no winner yet';}
        ?>
    </body>
</html>
