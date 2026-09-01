<?php
$cartTotal = $_GET['total'];

if ($cartTotal < 50) {
    $discountRate = 0;
} elseif ($cartTotal < 100) {
    $discountRate = 0.10;
} elseif ($cartTotal < 200) {
    $discountRate = 0.15;
} else {
    $discountRate = 0.20;
}

$discount = $cartTotal * $discountRate;
$finalPrice = $cartTotal - $discount;

echo "Original Price: P" . number_format($cartTotal, 2) . "<br>";
echo "Discount Amount: P" . number_format($discount, 2) . "<br>";
echo "Final Price: P" . number_format($finalPrice, 2);
?>