<?php
//Verbindung zur Datenbank aufbauen
require_once 'dbconnect.php';
mysqli_set_charset($db, 'utf8'); //nöd nötig wen nix mb4 (https://forums.digitalpoint.com/threads/mysql-collation-utf8-differences.2721197/)

// Daten einfügen
function Registrieren ($Benutzername, $BenVorname, $BenNachname, $BenTelefonnummer, $BenPasswort)
{
global $db;
//Tabelle füllen
$sql = "INSERT INTO tbenutzer (BenutzerId, BenNickname, BenVorname, BenNachname, BenTelefonnummer, BenPasswort) VALUES (NULL, '$Benutzername', '$BenVorname', '$BenNachname', '$BenTelefonnummer','$BenPasswort');";
$sql = mysqli_query($db, $sql) or die ("Error message: " . mysqli_error($db));
}
function hashpw($password)
{
  $salt="dsfsf";
  $pwsaltedmd5 =md5 ($password.$salt);

  return sha1($pwsaltedmd5) ;

}
// Benutzerdaten auslesen
function getUser ($BenNickname)
{
  //Tabelle auselsen
  global $db;
  $sql = "SELECT BenutzerId,BenNickname,BenPasswort FROM tbenutzer WHERE BenNickname = '$BenNickname';";
  $result = mysqli_query($db, $sql) or die ("Error message: " . mysqli_error($db));
  $user = mysqli_fetch_assoc($result);
  return $user;
}

//Login
function login($user, $password)
{
return $user['BenPasswort']==hashpw($password);
}

// Datenauslesen
function DatenAuslesen ($BenutzerId,  $sql)
{
  //Tabelle auselsen

  global $db;
  $result = mysqli_query($db, $sql) or die ("Error message: " . mysqli_error($db));
  $userarr = [];
  while ($row = $result->fetch_assoc()){
   $userarr[]=$row;
  }
    echo json_encode($userarr);
}


// Daten aktualisieren
function PositionUpdate($BenutzerId,$BenLongitude, $BenLatitude)
{
global $db;
//Tabelle updaten
$sql = "UPDATE tbenutzer set BenLongitude=$BenLongitude, BenLatitude=$BenLatitude, BenGeoTime=now() where BenutzerId = '$BenutzerId';";
mysqli_query($db, $sql) or die ("Error message: " . mysqli_error($db));
}
