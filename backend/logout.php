<?php
// Mulai session
session_start();

// Hancurkan session untuk logout
session_unset();
session_destroy();

// Arahkan ke halaman login
header("Location: login.php");
exit();
