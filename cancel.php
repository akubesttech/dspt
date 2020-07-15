<?php
//session_destroy();
unset($_SESSION['temppin']);
unset($_SESSION['tempserial']);
header('location:apply_b.php?view=Return');

?>