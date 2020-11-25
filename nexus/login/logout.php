<?php
  if (isset($_POST['logout'])) {
    // code...
    session_start();

    session_destroy();
    header("Location:/nexus");
  }
?>
