<?php
session_start();

// Αν δεν υπάρχει καλάθι, το αρχικοποιούμε
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Αν δεν υπάρχει action, επιστροφή στο καλάθι
if (!isset($_POST['action'])) {
    header("Location: cart.php");
    exit();
}

$product_id = $_POST['product_id'] ?? null;
$action = $_POST['action'];

// Εκτελούμε ενέργειες
switch ($action) {
    case 'increase':
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        }
        break;

    case 'decrease':
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']--;
            if ($_SESSION['cart'][$product_id]['quantity'] <= 0) {
                unset($_SESSION['cart'][$product_id]);
            }
        }
        break;

    case 'remove':
        unset($_SESSION['cart'][$product_id]);
        break;

    case 'clear_all':
        $_SESSION['cart'] = [];
        break;
}

// Επιστροφή στο καλάθι
header("Location: cart.php");
exit();
?>