<?php
session_start();

// ===== Έναρξη Καλαθιού αν δεν υπάρχει =====
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// ===== Επεξεργασία Προσθήκης στο Καλάθι =====
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Αν υπάρχει ήδη στο καλάθι, αύξηση ποσότητας
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        // Διαφορετικά, προσθήκη νέου προϊόντος
        $_SESSION['cart'][$product_id] = [
            'title' => $_POST['title'] ?? '',
            'price' => $_POST['price'] ?? 0,
            'image' => $_POST['image'] ?? '',
            'quantity' => 1
        ];
    }

    // ===== Redirect πίσω με μηνυμα προσθήκης =====
    $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php'; // Αν δεν υπάρχει, πήγαινε στην index
    if (strpos($referer, '?') !== false) {
        $redirect = $referer . "&added=1";
    } else {
        $redirect = $referer . "?added=1";
    }

    header("Location: " . $redirect);
    exit;
}
?>