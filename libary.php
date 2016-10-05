<?php
//Verbindung zur Datenbank aufbauen
require_once 'dbconnect.php';
mysqli_set_charset($db, 'utf8'); //nöd nötig wen nix mb4 (https://forums.digitalpoint.com/threads/mysql-collation-utf8-differences.2721197/)

// Daten einfügen
function Registrieren ($Benutzername, $BenVorname, $BenNachname, $BenTelefonnummer, $BenLongitude, $BenLatitude, $BenGeoTime, $BenPasswort)
{
global $db;
//Tabelle füllen
$sql = "INSERT INTO tbenutzer (BenutzerId, BenNickname, BenVorname, BenNachname, BenTelefonnummer, BenLongitude, BenLatitude, BenGeoTime, BenPasswort) VALUES (NULL, '$Benutzername', '$BenVorname', '$BenNachname', '$BenTelefonnummer', '$BenLongitude', '$BenLatitude', '$BenGeoTime','$BenPasswort');";
$sql = mysqli_query($db, $sql) or die ("Error message: " . mysqli_error($db));
}
function hashpw($password)
{
  $salt="dsfsf";
  $pwsaltedmd5 =md5 ($password.$salt);

  return sha1($pwsaltedmd5) ;

}
// Daten auslesen
function getUser ($BenNickname)
{
  //Tabelle auselsen
  global $db;
  $sql = "SELECT BenutzerId,BenNickname,BenPasswort FROM tbenutzer WHERE BenNickname = '$BenNickname';";
  $result = mysqli_query($db, $sql) or die ("Error message: " . mysqli_error($db));
  $user = mysqli_fetch_assoc($result);
  return $user;
}
function login($user, $password)
{
return $user['BenPasswort']==hashpw($password);


}

function DatenAuslesen ($BenutzerId)
{
  //Tabelle auselsen
  global $db;
  $sql = "SELECT * FROM tbenutzer WHERE BenutzerId = '$BenutzerId';";
  $result = mysqli_query($db, $sql) or die ("Error message: " . mysqli_error($db));
  $user = mysqli_fetch_assoc($result);
  $BenutzerId = $user['BenutzerId'];
  $Benutzername = $user['BenNickname'];
  $BenVorname = $user['BenVorname'];
  $BenNachname = $user['BenNachname'];
  $BenTelefonnummer = $user['BenTelefonnummer'];
  $BenLongitude = $user['BenLongitude'];
  $BenLatitude = $user['BenLatitude'];
  $BenGeoTime = $user['BenGeoTime'];
  $BenPasswort = $user['BenPasswort'];
}

// Daten aktualisieren
function PositionUpdate($BenutzerId, $Benutzername, $BenVorname, $BenNachname, $BenTelefonnummer, $BenLongitude, $BenLatitude, $BenGeoTime, $BenPasswort) //name gänderet
{

//Charset definieren
//mysqli_set_charset($db, 'utf8mb4'); //REDUNDANT

//Tabelle updaten
$sql = "UPDATE tbenutzer set (BenLongitude, BenLatitude, BenGeoTime) VALUES ('$BenLongitude', '$BenLatitude', '$BenGeoTime') where BenutzerId = '$BenutzerId';";
$sql = mysqli_query($db, $sql) or die ("Error message: " . mysqli_error($db)); //maybe bessere name für variable? well du chunsch kei sql über maybe $reponse or sth like this
}

//To do
//-Datenüberprüfung,
