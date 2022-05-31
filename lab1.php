<?php

    $random_number_array = range(0, 100);
    shuffle($random_number_array );
    $random_number_array = array_slice($random_number_array ,0,3);

    foreach( $random_number_array as $key => $value ){
        echo $key."\t=>\t".$value."\n";
    }

    echo("унарний плюс <br>");
    echo(+$random_number_array[0]);
    echo("унарний мінус <br>");
    echo(-$random_number_array[0]);
    echo("інкременто <br>");
    echo(++$random_number_array[0]);
    echo("декременто <br>");
    echo(--$random_number_array[0]);
    echo("додавання <br>");
    echo($random_number_array[0]+$random_number_array[1]+$random_number_array[2]);
    echo("віднімання <br>");
    echo($random_number_array[0]-$random_number_array[1]-$random_number_array[2]);
    echo("множення <br>");
    echo($random_number_array[0]*$random_number_array[1]*$random_number_array[2]);
    echo("ділення <br>");
    echo($random_number_array[0]/$random_number_array[1]/$random_number_array[2]);
    echo("ділення по модулю(остача) <br>");
    echo($random_number_array[0]%$random_number_array[1]%$random_number_array[2]);
    echo("степінь <br>");
    echo($random_number_array[0]**$random_number_array[1]);

?>
