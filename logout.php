<?php
session_start();
session_unset();
header('Location: principal.php');
?>