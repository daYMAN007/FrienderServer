<?php
require_once 'settings.php';

$sql='CREATE TABLE IF NOT EXISTS TBenutzer(
    BenutzerId INT(5) AUTO_INCREMENT primary key ,
    BenVorname varchar(45),
    BenNachname varchar(45),
    BenTelefonnummer varchar(45),
    BenLatitude FLOAT(10,6),
    BenLongitude FLOAT(10,6),
    BenGeoTime DATETIME,
    BenNickname Varchar(45),
    BenPasswort Varchar(62)
    );
	alter table TBenutzer AUTO_INCREMENT=1000;
	';

$db = mysqli_connect("$dbhost", "$dbusername", "$dbpassword")or die("Error " . mysqli_error($db));

if(mysqli_query($db,"CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET = utf8 COLLATE = utf8_general_ci;
"))
{
  $db = mysqli_connect("$dbhost", "$dbusername", "$dbpassword","$dbname")or die("Error " . mysqli_error($db));
}

if(mysqli_multi_query($db,$sql))
        {
            echo "DB und Tables wurden erstellt ";
            echo "<br>Diese Datei sollte zur Sicherheit gelöscht werden";

        }
       else

       {
                   printf("Error: %s\n", mysqli_error($db));
       }

       mysqli_close($db);
