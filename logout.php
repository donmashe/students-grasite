<?php
require 'index.php';
session_destroy();
header('location: '.$http_referer);
?>