<?php
session_start();

// ===== Αν δεν υπάρχει καλάθι, το αρχικοποιούμε =====
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Καλάθι Αγορών</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<?php include("navbar.php"); ?>

<?php if (isset($_GET['added'])): ?>
    <div class="flash-message">🛒 Προστέθηκε στο καλάθι!</div>
<?php endif; ?>

<h2 class="category-title" style="color: orange; text-align: center; margin-top: 30px;">
    Το καλάθι σας!
</h2>

<div class="products-container">
<?php if (empty($_SESSION['cart'])): ?>
    <p class="empty-cart-message">Είναι άδειο!</p>
<?php else: ?>
    <?php foreach ($_SESSION['cart'] as $id => $item): ?>
        <div class="product-card">
            <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
            <h3><?= htmlspecialchars($item['title']) ?></h3>
            <p class="description">Ποσότητα: <?= $item['quantity'] ?></p>
            <p class="price">Σύνολο: <?= number_format($item['price'] * $item['quantity'], 2) ?> &euro;</p>

            <!-- Φόρμες διαχείρισης ποσότητας -->
            <form action="update_cart.php" method="post" style="display:inline;">
                <input type="hidden" name="product_id" value="<?= $id ?>">
                <input type="hidden" name="action" value="increase">
                <button type="submit">➕</button>
            </form>

            <form action="update_cart.php" method="post" style="display:inline;">
                <input type="hidden" name="product_id" value="<?= $id ?>">
                <input type="hidden" name="action" value="decrease">
                <button type="submit">➖</button>
            </form>

            <form action="update_cart.php" method="post" style="display:inline;">
                <input type="hidden" name="product_id" value="<?= $id ?>">
                <input type="hidden" name="action" value="remove">
                <button type="submit">🗑️</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
</div>

<?php if (!empty($_SESSION['cart'])): ?>
    <form action="update_cart.php" method="post" style="text-align:center; margin-top:20px;">
        <input type="hidden" name="action" value="clear_all">
        <button type="submit" class="clear-cart">Καθαρισμός καλαθιού</button>
    </form>

    <form action="complete_purchase.php" method="post" style="text-align:center; margin-top:20px;">
        <button type="submit" class="purchase-button">🛍️ Ολοκλήρωση Αγοράς</button>
    </form>
<?php endif; ?>

<?php include("footer.php"); ?>

<!-- ===== Flash Message Script ===== -->
<script>
    setTimeout(() => {
        const flash = document.querySelector('.flash-message');
        if (flash) {
            flash.remove();
        }
    }, 4000);
</script>

</body>
</html>