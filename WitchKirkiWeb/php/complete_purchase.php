<?php
session_start();
require_once("db_connection.php");

// ===== Έλεγχος αν υπάρχει καλάθι και αν είναι άδειο =====
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

// ===== Υπολογισμός συνολικού ποσού παραγγελίας και λεπτομέρειες =====
$total = 0;
$details = [];
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
    $details[] = [
        'title' => $item['title'],
        'quantity' => $item['quantity'],
        'price_per_unit' => $item['price']
    ];
}
$details_json = json_encode($details, JSON_UNESCAPED_UNICODE);

// ===== Καταχώρηση παραγγελίας Επισκέπτη =====
if (isset($_POST['guest_name'])) {
    $guest_name = $_POST['guest_name'];
    $guest_email = $_POST['guest_email'];
    $guest_address = $_POST['guest_address'];
    $guest_phone = $_POST['guest_phone'];
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv']; // Συλλέγεται αλλά δεν αποθηκεύεται

    $stmt = $conn->prepare("INSERT INTO orders (details, total_amount, guest_name, guest_email, guest_address, guest_phone, guest_card, expiry_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdssssss", $details_json, $total, $guest_name, $guest_email, $guest_address, $guest_phone, $card_number, $expiry_date);
    $stmt->execute();
    $stmt->close();

    $_SESSION['cart'] = [];
    header("Location: thank_you.php");
    exit();
}

// ===== Καταχώρηση παραγγελίας Εγγεγραμμένου Χρήστη =====
if (isset($_POST['shipping_address']) && isset($_POST['card_number'])) {
    $shipping_address = $_POST['shipping_address'];
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv']; // Συλλέγεται αλλά δεν αποθηκεύεται
    $vat_number = $_POST['vat_number'];

    $stmt = $conn->prepare("INSERT INTO orders (user_id, details, total_amount, shipping_address, card_number, expiry_date, vat_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isdssss", $_SESSION['user_id'], $details_json, $total, $shipping_address, $card_number, $expiry_date, $vat_number);
    $stmt->execute();
    $stmt->close();

    $_SESSION['cart'] = [];
    header("Location: thank_you.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Ολοκλήρωση Αγοράς</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<?php include("navbar.php"); ?>

<div class="form-container">

    <h2>Ανασκόπηση Παραγγελίας</h2>

    <!-- ===== Πίνακας Προϊόντων ===== -->
    <table class="order-review-table">
        <thead>
            <tr>
                <th>Προϊόν</th>
                <th>Ποσότητα</th>
                <th>Τιμή Μονάδας</th>
                <th>Σύνολο</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($details as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['title']) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($item['price_per_unit'], 2) ?> €</td>
                    <td><?= number_format($item['price_per_unit'] * $item['quantity'], 2) ?> €</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3 class="order-total">
        Συνολικό Ποσό: <?= number_format($total, 2) ?> €
    </h3>

    <!-- ===== Φόρμα για Εγγεγραμμένο Χρήστη ή Επισκέπτη ===== -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <h2>Στοιχεία Αποστολής & Πληρωμής</h2>
        <form method="post" action="complete_purchase.php">
            <label>Διεύθυνση Αποστολής:</label>
            <textarea name="shipping_address" required pattern=".{5,}"></textarea>

            <label>Αριθμός Κάρτας:</label>
            <input type="text" name="card_number" pattern="[0-9]{16}" maxlength="16" required placeholder="16 ψηφία">

            <label>Ημερομηνία Λήξης:</label>
            <input type="text" name="expiry_date" pattern="(0[1-9]|1[0-2])\/[0-9]{2}" maxlength="5" required placeholder="MM/YY">

            <label>Κωδικός CVV:</label>
            <input type="text" name="cvv" pattern="[0-9]{3}" maxlength="3" required placeholder="3 ψηφία">

            <label>ΑΦΜ (Μόνο για επαγγελματίες):</label>
            <input type="text" name="vat_number" pattern="[0-9]{9}" placeholder="9 ψηφία">

            <input type="submit" value="Ολοκλήρωση Αγοράς">
        </form>

    <?php else: ?>
        <h2>Στοιχεία Επισκέπτη</h2>
        <form method="post" action="complete_purchase.php">
            <label>Ονοματεπώνυμο:</label>
            <input type="text" name="guest_name" required pattern="[A-Za-zΑ-Ωα-ω\s]{3,}" title="Μόνο γράμματα και τουλάχιστον 3 χαρακτήρες">

            <label>Email:</label>
            <input type="email" name="guest_email" required>

            <label>Διεύθυνση:</label>
            <input type="text" name="guest_address" required pattern=".{5,}" title="Τουλάχιστον 5 χαρακτήρες">

            <label>Τηλέφωνο:</label>
            <input type="tel" name="guest_phone" required pattern="[0-9]{10}" placeholder="10 ψηφία">

            <label>Αριθμός Κάρτας:</label>
            <input type="password" name="card_number" pattern="[0-9]{16}" maxlength="16" required placeholder="16 ψηφία" title="16 αριθμητικά ψηφία">

            <label>Ημερομηνία Λήξης:</label>
            <input
            type="text"
            name="expiry_date"
            pattern="(0[1-9]|1[0-2])\/[0-9]{2}"
            maxlength="5"
            required
            placeholder="MM/YY"
             title="Μορφή MM/YY, π.χ. 08/23"
             />

           <label>Κωδικός CVV:</label>
           <input
           type="text"
           name="cvv"
           pattern="[0-9]{3}"
           maxlength="3"
           required
           placeholder="3 ψηφία"
           title="Ακριβώς 3 αριθμητικά ψηφία, π.χ. 123"
            />

            <input type="submit" value="Ολοκλήρωση Παραγγελίας">
        </form>
    <?php endif; ?>

</div>

<?php include("footer.php"); ?>

</body>
</html>