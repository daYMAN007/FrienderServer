<?php

require_once 'settings.php';

$db = mysqli_connect("$dbhost", "$dbusername", "$dbpassword","$dbname")or die("Error " . mysqli_error($db));      
global $db ;