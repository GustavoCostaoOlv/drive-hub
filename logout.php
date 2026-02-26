<?php
// logout.php
session_start();
session_destroy();
header('Location: login.php?saiu=1');
exit;
?>