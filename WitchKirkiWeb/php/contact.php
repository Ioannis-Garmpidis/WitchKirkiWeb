<?php
session_start();
$user = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="el">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Επικοινωνία</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

<!-- ======= Εισαγωγή Navbar ======= -->
<?php include 'navbar.php'; ?>

<!-- ======= Ενότητα Επικοινωνίας ======= -->
<section class="contact-container">

  <!-- ======= Κατάστημα / Διευθύνσεις ======= -->
  <div class="box1">
    <p>Θα χαρούμε πολύ να μας επισκεφθείτε σε ένα από τα δύο καταστήματά μας σε Αθήνα και Θεσσαλονίκη για να σας γνωρίσουμε από κοντά!!!</p>
    
    <p><strong>Κατάστημα Θεσσαλονίκης:</strong><br>Λυδίας 4<br>Τηλ. επικοινωνίας: 2310-784460</p>
    
    <p><strong>Κατάστημα Αθήνας:</strong><br>Ούλωφ Πάλμε 35<br>Τηλ. επικοινωνίας: 210-321654</p>
    
    <p><strong>Ωράριο Καταστημάτων:</strong><br>
       Καθημερινά 09:00 - 21:00<br>
       Σάββατο 09:00 - 20:00<br>
       Αργίες: Κλειστά
    </p>
  </div>

  <!-- ======= Εργασία στην Witch Kirki ======= -->
  <div class="box2">
    <img id="paw2" src="../media/images/imgPaw.png" alt="Paw logo">
    <p>Εάν ενδιαφέρεστε να γίνετε μέλος της οικογένειάς μας,<br> 
    μπορείτε να στείλετε το βιογραφικό σας στο email:<br> 
    <strong>Witch_Kirki@gmail.com</strong></p>
  </div>

  <!-- ======= Social Media / Giveaways ======= -->
  <div class="box3">
    <img id="social2" src="../media/images/imgSocial.png" alt="Social media">
    <p>Μέσω των social media, η σχέση μας γίνεται πιο διαδραστική!<br>
    Θα σας γεμίσουμε δώρα μέσα από αμέτρητα<br>
    giveaways και διαγωνισμούς!!!</p>
  </div>

</section>

<!-- ======= Footer ======= -->
<?php include 'footer.php'; ?>

</body>
</html>