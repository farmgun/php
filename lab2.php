<?php
echo "4.22<br>";
$number1 = 14;
$number2 = 67;

echo "дані числа $number1 і $number2 <br>";
echo(" <br>");

function foo1($arg_1)
{
    echo ($arg_1 % 2) ? "$arg_1 - непарне<br>" : "$arg_1 - парне<br>";
    echo ($arg_1 % 10 == 7) ? "$arg_1 - закінчується на 7 <br>" : "$arg_1 - не закінчується на 7 <br>";
    echo(" <br>");
}

foo1($number1);
foo1($number2);
echo(" <br>");



echo "4.25<br>";

$number3 = 32;
$number4 = 67;

echo "дані числа $number3 і $number4 <br>";
echo(" <br>");

function foo2($arg_1)
{
    $a = 8;
    $array = str_split($arg_1);
    $summ = $array[0] + $array[1];
    echo ($summ >= 10) ? "$summ - двузначне<br>" : "$summ - однозначне<br>";
    echo ($summ > $a)  ? "$summ > $a<br>" : "$summ < $a<br>";
    echo(" <br>");
}

foo2($number3);
foo2($number4);
echo(" <br>");


echo "4.30<br>";

$number5 = 321;
$number6 = 979;

echo "дані числа $number5 і $number6 <br>";
echo(" <br>");

function foo3($arg_1)
{
    $a = 25;
    $array = str_split($arg_1);
    $summ = $array[0] + $array[1] + $array[2];
    echo ($summ >= 10) ? "$summ - двузначне<br>" : "$summ - однозначне<br>";
    $x = $array[0] * $array[1] * $array[2];
    echo ($x >= 100) ? "$x - тризначне<br>" : "$x - не тризначне<br>";
    echo ($x > $a)  ? "$x > $a<br>" : "$x < $a<br>";
    echo ($summ % 5) ? "$summ - не кратне 5<br>" : "$summ - кратне 5<br>";
    echo ($summ % $a) ? "$summ - не кратне $a<br>" : "$summ - кратне $a<br>";
    echo(" <br>");
}

foo3($number5);
foo3($number6);
?>