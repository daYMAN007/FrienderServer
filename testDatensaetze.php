<?php
require_once 'settings.php';

$sql="INSERT INTO tbenutzer values (Null, 'Patricia', 'Rocha', '070 516 90 34', '9,15287', '47,377133', '2016-10-06 14:59:46', 'a', 'ea144d925f1e28b4f6b7ec625f55d1e5e94f6763');
INSERT INTO tbenutzer values (Null, 'Natalia', 'Bond', '034 285 15 44', '7,651373', '47,024333', '2016-10-06 14:59:46', 'b', 'ea144d925f1e28b4f6b7ec625f55d1e5e94f6763');
INSERT INTO tbenutzer values (Null, 'Marsha', 'Kennedy', '002 516 90 34', '-1,319893', '-48,488696', '2016-10-06 14:59:46', 'c', 'ea144d925f1e28b4f6b7ec625f55d1e5e94f6763');
INSERT INTO tbenutzer values (Null, 'Jessica', 'Pierce', '002 517 90 34', '-118,114543', '34,043818', '2016-10-06 14:59:46', 'd', 'ea144d925f1e28b4f6b7ec625f55d1e5e94f6763');
INSERT INTO tbenutzer values (Null, 'Carole', 'Motley', '002 518 90 34', '43,320055', '5,424962', '2016-10-06 14:59:46', 'e', 'ea144d925f1e28b4f6b7ec625f55d1e5e94f6763');
INSERT INTO tbenutzer values (Null, 'Michael', 'Helwig', '002 519 90 34', '11,549801', '48,763982', '2016-10-06 14:59:46', 'f', 'ea144d925f1e28b4f6b7ec625f55d1e5e94f6763');";
$db = mysqli_connect("$dbhost", "$dbusername", "$dbpassword")or die("Error " . mysqli_error($db));

if(mysqli_query($db,"CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET = utf8 COLLATE = utf8_general_ci;
"))
{
  $db = mysqli_connect("$dbhost", "$dbusername", "$dbpassword","$dbname")or die("Error " . mysqli_error($db));
}

if(mysqli_multi_query($db,$sql))
        {
            echo "Testdatensätze wurden erstellt ";
            echo "<br>Diese Datei sollte zur Sicherheit gelöscht werden";

        }
       else

       {
                   printf("Error: %s\n", mysqli_error($db));
       }

       mysqli_close($db);
