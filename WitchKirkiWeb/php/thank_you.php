<?php
session_start();
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Ευχαριστούμε!</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php include("navbar.php"); ?>

<!-- Μήνυμα επιτυχούς παραγγελίας -->
<div class="form-container">
    <h2 style="text-align: center; color: orange; margin-top: 20px;">Ευχαριστούμε για την αγορά σας!</h2>

    <p style="color: white; text-align: center; margin-top: 20px;">
        Η παραγγελία σας καταχωρήθηκε επιτυχώς.<br>Θα επικοινωνήσουμε σύντομα μαζί σας!
    </p>

    <!-- Κουμπί Επιστροφής στην Αρχική -->
    <div style="text-align: center; margin-top: 30px;">
        <a href="index.php" class="purchase-button">Επιστροφή στην Αρχική</a>
    </div>
</div>

<?php include("footer.php"); ?>

</body>
</html>