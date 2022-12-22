<?php

// menghancur session supaya tidak masuk lagi halaman index;
session_start();

//  ditimpa dengan array kosong supaya aman dan ada beberapa kasus session masih belum dihancurkan , untuk jaga';
$_SESSION = [];
session_unset();
session_destroy();

// tendang ke halaman login
header("Location: login.php");
exit;