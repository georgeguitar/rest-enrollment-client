<?php
// start a session
session_start();
 
// assume that we’ve initialized a couple of session variables in the other script already
 
// destroy everything in this session
session_destroy();
header('Location: index.php');
?>