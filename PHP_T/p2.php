<?php
// PHP Variable Scope
// global
// local
// static

// global scope 
$num1 = 5;

function showNumber()
{
    // local variable 
    $num2 = 5;
    echo "local variable $num2 \n";
    // echo "Global variable inside function $num1"; // invalid : Undefined variable $num1
}
// i can not acess $num2 outside function 
// echo "try to get $num2 \n"; // Undefined variable $num2

showNumber();




// Static Scope
function upNumber()
{
    static $num = 0;
    echo $num . "\n";
    $num++;
}

upNumber();
upNumber();
upNumber();



// Static Scope
function upNumber2()
{
    $num = 0;
    echo $num . "\n";
    $num++;
}

// predict output 
upNumber2();
upNumber2();
upNumber2();



$global_num = 8;

function callGlobalFunction()
{
    global $global_num, $global_num1;
    $global_num1 = $global_num;
    echo "$global_num \n";
}
callGlobalFunction();
echo $global_num1 . "\n";
