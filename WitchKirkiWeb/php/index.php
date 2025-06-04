<?php
// ===== Ξεκινάμε το Session =====
session_start();

// ===== Αποθήκευση στοιχείων χρήστη αν υπάρχει σύνδεση =====
$user = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : null;

// ===== Λογική για εμφάνιση Popups =====
$popupSeen = isset($_SESSION['popup_shown']); // Έχει δει ήδη popup σύνδεσης;
$showGoodbye = isset($_GET['loggedout']) && !$user; // Έγινε αποσύνδεση χρήστη;
$showLoginPopup = !$user && !$popupSeen && !$showGoodbye; // Δεν είναι συνδεδεμένος και δεν έχει δει popup

if ($showLoginPopup) {
    $_SESSION['popup_shown'] = true; // Σημειώνουμε ότι έχει δει το popup
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Witch Kirki - Αρχική</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">

    <!-- ===== Scripts εμφάνισης Popups ===== -->
    <?php if ($showLoginPopup): ?>
    <script>
    window.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            const popup = document.getElementById('popup-login');
            if (popup) popup.style.display = 'flex';
        }, 5000); // Εμφάνιση του popup μετά από 5 δευτερόλεπτα
    });
    </script>
    <?php endif; ?>

    <?php if ($showGoodbye): ?>
    <script>
    window.addEventListener('DOMContentLoaded', () => {
        const popup = document.getElementById('popup-goodbye');
        if (popup) popup.style.display = 'flex';
    });
    </script>
    <?php endif; ?>

    <!-- ===== Συναρτήσεις Κλεισίματος Popups ===== -->
    <script>
    function closePopup(id) {
        const el = document.getElementById(id);
        if (el) el.style.display = 'none';
    }

    function closeGoodbyeAndShowLogin() {
        closePopup('popup-goodbye');
        setTimeout(() => {
            const loginPopup = document.getElementById('popup-login');
            if (loginPopup) loginPopup.style.display = 'flex';
        }, 5000);
    }
    </script>
</head>

<body>

<!-- ===== Navbar Εισαγωγή ===== -->
<?php include("navbar.php"); ?>

<!-- ===== Μήνυμα Καλωσορίσματος ===== -->
<?php if ($user): ?>
    <h3 class="welcome-message">
        Καλωσήρθες, <?php echo htmlspecialchars($user); ?>!
    </h3>
<?php endif; ?>

<!-- ===== Κατηγορίες Προϊόντων ===== -->
<section class="categories">
    <div class="row1">
        <div class="category1">
            <a href="products.php?category=0-6 μηνών"><img class="paw" src="../media/images/imgPaw.png" alt="0-6 μηνών"></a>
            <p>0-6 Μηνών</p>
        </div>
        <div class="category2">
            <a href="products.php?category=6-12 μηνών"><img class="paw" src="../media/images/imgPaw.png" alt="6-12 μηνών"></a>
            <p>6-12 Μηνών</p>
        </div>
        <div class="category3">
            <a href="products.php?category=12-24 μηνών"><img class="paw" src="../media/images/imgPaw.png" alt="12-24 μηνών"></a>
            <p>12-24 Μηνών</p>
        </div>
    </div>

    <div class="row2">
        <div class="category4">
            <a href="products.php?category=2-3 ετών"><img class="paw" src="../media/images/imgPaw.png" alt="2-3 ετών"></a>
            <p>2-3 Ετών</p>
        </div>
        <div class="category5">
            <a href="products.php?category=3-5 ετών"><img class="paw" src="../media/images/imgPaw.png" alt="3-5 ετών"></a>
            <p>3-5 Ετών</p>
        </div>
        <div class="category6">
            <a href="products.php?category=5-8 ετών"><img class="paw" src="../media/images/imgPaw.png" alt="5-8 ετών"></a>
            <p>5-8 Ετών</p>
        </div>
    </div>

    <div class="row3">
        <div class="category7">
            <a href="products.php?category=8-12 ετών"><img class="paw" src="../media/images/imgPaw.png" alt="8-12 ετών"></a>
            <p>8-12 Ετών</p>
        </div>
        <div class="category8">
            <a href="products.php?category=12-15 ετών"><img class="paw" src="../media/images/imgPaw.png" alt="12-15 ετών"></a>
            <p>12-15 Ετών</p>
        </div>
        <div class="category9">
            <a href="products.php?category=15plus ετών"><img class="paw" src="../media/images/imgPaw.png" alt="15+ ετών"></a>
            <p>15+ Ετών</p>
        </div>
    </div>
</section>

<!-- ===== Footer ===== -->
<?php include("footer.php"); ?>

<!-- ===== Popup Σύνδεσης ===== -->
<div id="popup-login" class="popup-container" style="display: none;">
    <div class="popup-box">
        <span class="popup-close" onclick="closePopup('popup-login')">✕</span>
        <h3>Καλώς ήρθατε! Επιλέξτε:</h3>
        <a href="login.php" class="popup-button">Σύνδεση</a>
        <a href="signup.php" class="popup-button">Εγγραφή</a>
        <a href="index.php" class="popup-button">Συνέχεια ως επισκέπτης</a>
    </div>
</div>

<!-- ===== Popup Αποχαιρετισμού ===== -->
<?php if ($showGoodbye): ?>
<div id="popup-goodbye" class="popup-container" style="display: none;">
    <div class="popup-box">
        <span class="popup-close" onclick="closePopup('popup-goodbye')">✕</span>
        <h3>Ευχαριστούμε για την επίσκεψη!</h3>
        <a class="popup-button" onclick="closeGoodbyeAndShowLogin()">Κλείσιμο</a>
    </div>
</div>
<?php endif; ?>

</body>
</html>