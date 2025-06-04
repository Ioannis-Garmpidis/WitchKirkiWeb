<?php
session_start();
require_once("db_connection.php");

// ======= Ανάγνωση χρήστη για το navbar =======
$user = $_SESSION['first_name'] ?? null;

// ======= Ανάγνωση κατηγορίας από το URL =======
$category = $_GET['category'] ?? '';

// ======= Προετοιμασία και εκτέλεση ερωτήματος για τα προϊόντα =======
$sql = "SELECT * FROM products WHERE category = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $category);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Προϊόντα - <?php echo htmlspecialchars($category); ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<?php include("navbar.php"); ?>

<!-- ======= Μήνυμα αν προστέθηκε προϊόν στο καλάθι ======= -->
<?php if (isset($_GET['added'])): ?>
    <div class="flash-message">🛒 Προστέθηκε στο καλάθι!</div>
<?php endif; ?>

<!-- ======= Τίτλος Κατηγορίας ======= -->
<h2 class="category-title">
    Κατηγορία: <?php echo htmlspecialchars($category); ?>
</h2>

<!-- ======= Εμφάνιση προϊόντων ======= -->
<div class="products-wrapper">
<?php while ($product = $result->fetch_assoc()): ?>
    <div class="product-card">
        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Προϊόν">
        <h3><?php echo htmlspecialchars($product['title']); ?></h3>
        <p class="description"><?php echo htmlspecialchars($product['description']); ?></p>
        <p class="price"><?php echo number_format($product['price'], 2); ?> €</p>

        <!-- ======= Φόρμα προσθήκης στο καλάθι ======= -->
        <form action="add_to_cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="title" value="<?php echo htmlspecialchars($product['title']); ?>">
            <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
            <input type="hidden" name="image" value="<?php echo $product['image']; ?>">
            <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">
            <button type="submit" class="add-to-cart">Προσθήκη στο καλάθι</button>
        </form>
    </div>
<?php endwhile; ?>
</div>

<!-- ======= Πλοήγηση σε άλλες κατηγορίες ======= -->
<div class="pages" style="text-align: center; margin: 30px 0;">
<?php
// Λίστα όλων των κατηγοριών
$categories = [
    "0-6 μηνών",
    "6-12 μηνών",
    "12-24 μηνών",
    "2-3 ετών",
    "3-5 ετών",
    "5-8 ετών",
    "8-12 ετών",
    "12-15 ετών",
    "15plus ετών"
];

// Βρίσκουμε σε ποια κατηγορία είμαστε τώρα
$currentIndex = array_search($category, $categories);

if ($currentIndex !== false) {
    // Προηγούμενη σελίδα
    if ($currentIndex > 0) {
        $prev = $categories[$currentIndex - 1];
        echo '<a class="page" href="products.php?category=' . urlencode($prev) . '"><< Προηγούμενη σελίδα</a> ';
    }
    // Επόμενη σελίδα
    if ($currentIndex < count($categories) - 1) {
        $next = $categories[$currentIndex + 1];
        echo '<a class="page" href="products.php?category=' . urlencode($next) . '">Επόμενη σελίδα >></a>';
    }
}
?>
</div>

<?php include("footer.php"); ?>

</body>
</html>