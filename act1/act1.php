<?php

$num = $_GET['num'];

if ($num > 0) {
    echo "The number is positive.<br>";

    if ($num % 2 == 0) {
        echo "The number is even.";
    } else {
        echo "The number is odd.";
    }
} elseif ($num < 0) {
    echo "The number is negative.";
} else {
    echo "The number is zero.";
}
?>

