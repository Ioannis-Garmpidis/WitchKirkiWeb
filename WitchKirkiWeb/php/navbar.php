<?php
// ======= Έναρξη συνεδρίας αν δεν έχει ξεκινήσει ήδη =======
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ======= Ορισμός μεταβλητής χρήστη (όνομα χρήστη) =======
$user = $_SESSION['first_name'] ?? null;

// ======= Εντοπισμός της τρέχουσας σελίδας για ενεργό link =======
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- ======= ΕΝΟΤΗΤΑ ΠΛΟΗΓΗΣΗΣ ======= -->
<section class="navbar">
  <div class="header">
    <h1>Witch Kirki</h1>
  </div>

  <div>
    <ul class="menu-list">

      <?php if (!isset($_SESSION['user_id'])): ?>
        <!-- Σύνδεση / Εγγραφή αν δεν είναι συνδεδεμένος -->
        <li class="menu-list-item">
          <a href="#" class="menu-link" onclick="openAuthPopup()">Σύνδεση ή Εγγραφή</a>
        </li>
      <?php endif; ?>

      <!-- Σταθεροί σύνδεσμοι navbar -->
      <li class="menu-list-item">
        <a class="menu-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="/WitchKirkiWeb/php/index.php">Αρχική</a>
      </li>
      <li class="menu-list-item">
        <a class="menu-link <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>" href="/WitchKirkiWeb/php/about.php">Σχετικά με εμάς</a>
      </li>
      <li class="menu-list-item">
        <a class="menu-link <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>" href="/WitchKirkiWeb/php/contact.php">Επικοινωνία</a>
      </li>
      <li class="menu-list-item">
        <a class="menu-link <?php echo ($current_page == 'cart.php') ? 'active' : ''; ?>" href="/WitchKirkiWeb/php/cart.php">Καλάθι Αγορών</a>
      </li>

      <?php if ($user): ?>
        <!-- Αποσύνδεση αν είναι συνδεδεμένος -->
        <li class="menu-list-item">
          <a class="menu-link" href="/WitchKirkiWeb/php/logout.php">Αποσύνδεση</a>
        </li>
      <?php endif; ?>

    </ul>
  </div>
</section>

<!-- ======= ΕΝΟΤΗΤΑ ΛΟΓΟΤΥΠΟΥ ΚΑΙ ΦΡΑΣΗΣ ======= -->
<section class="logo">
  <img id="logo-img" src="/WitchKirkiWeb/media/images/imgKirki.png" alt="Λογότυπο Witch Kirki">
  <div class="phrase">
    <h2>Παιχνίδια για μικρά και μεγάλα παιδιά...!!!</h2>
  </div>
</section>

<!-- ======= Φράση Always ======= -->
<subtitle id="always">Always...</subtitle>

<!-- ======= POPUP για Σύνδεση ή Εγγραφή ======= -->
<div id="authPopup" class="popup-container" style="display: none;">
  <div class="popup-box">
    <h3>Θέλετε να συνδεθείτε ή να εγγραφείτε;</h3>
    <a href="/WitchKirkiWeb/php/login.php" class="popup-button">Σύνδεση</a>
    <a href="/WitchKirkiWeb/php/signup.php" class="popup-button">Εγγραφή</a>
    <div class="popup-close" onclick="closeAuthPopup()">✕</div>
  </div>
</div>

<!-- ======= JAVASCRIPT για διαχείριση popup ======= -->
<script>
function openAuthPopup() {
  document.getElementById('authPopup').style.display = 'flex';
}

function closeAuthPopup() {
  document.getElementById('authPopup').style.display = 'none';
}
</script>