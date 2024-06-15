<?php
session_start();

session_destroy();

echo"<script>window.open('homePage.php','_self')</script>";
?>