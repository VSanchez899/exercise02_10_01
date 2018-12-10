<?php
$errorMsgs = array();
$hostname = "10.106.15.127";
$username = "adminer";
$passwd = "judge-quck-25";
$DBName = "onlinestores1";
    $DBConnect = new mysqli("$hostname", "$username", "$passwd", "$DBName");
?>