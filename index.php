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
    </head>
    <body>
        <?php
        //check if a board parameter was passed
        if(!isset($_GET['board'])){echo 'nothing to show here';}
        else {
            $temp = "jim";
            echo 'Hi, name is '.$temp.' ME GO FACE SMOrc SMOrc Kappa';
            class Game {
                var $position;
                function Game($squares){
                    $this->position = str_split($squares);
                }
                
                function __display(){
                    echo '<table cols="3" style="font-size:large; font-weight:bold">';
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
                    $this-> newposition = $this->position;
                    $this-> newposition[$which] = 'o';
                    $move = implode($this->newposition);
                    
                    $link = 'http://localhost/ACIT4850Lab1/index.php/?board='.$move;
                    return '<td><a href="'.$link.'">-</a></td>';
                }
                
                function __winner($token){
                    $winner = 0;
                    for($row=0; $row<3; $row++){
                        $result = 0;
                        for($col=0; $col<3; $col++){
                            if($this->position[(3*$row + $col)] == $token) {$result++;}
                            
                        }
                        if($result == 3){$winner++;}
                    }
                    for($col=0; $col<3; $col++){
                        $result = 0;
                        for($row=0; $row<3; $row++){
                            if($this->position[(3*$col + $row)] == $token) {$result++;}
                        }
                        if($result == 3){$winner++;}
                    }
                    //*diagonal1
                    if( ($this->position[0] == $token) && 
                        ($this->position[4] == $token) && 
                        ($this->position[8] == $token))
                    { $winner++; }
                    //*diagonal2
                    else if(($this->position[2] == $token) && 
                        ($this->position[4] == $token) && 
                        ($this->position[6] == $token))
                    { $winner++; }
                return $winner;   
                }
            }
            
            $position = $_GET['board'];
            //$squares = str_split($position);
            $game = new Game($position);
            $game->__display();
            echo $game->__winner('x');
            echo $game->__winner('o');
            if($game->__winner('x') == true ){echo 'WINNER!';}
            else if ($game->__winner('o') == true ){echo 'I win too bad';}
            else {echo 'no winner yet';}

        }
        ?>
    </body>
</html>
