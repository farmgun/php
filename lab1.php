<?php

    echo "Hello world";

    $random_number_array = range(0, 100);
    shuffle($random_number_array );
    $random_number_array = array_slice($random_number_array ,0,3);

    print_r($random_number_array);  

?>