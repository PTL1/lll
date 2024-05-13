<?php 
 session_start();
 include('server.php');
 $errors = array();
 if (isset($_POST['log_user']))