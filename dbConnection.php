<?php
// btw i ha mi asi gfühlt wo i fascht alles glöscht ha
//Verbindung zur Datenbank aufbauen //damian:delete da?
$BenutzerId;
$Benutzername;
$BenVorname;
$BenNachname;
$BenTelefonnummer;
$BenLongitude;
$BenLatitude;
$BenGeoTime;
$BenPasswort;

require_once 'dbconnect.php';
mysqli_set_charset($db, 'utf8'); //nöd nötig wen nix mb4 (https://forums.digitalpoint.com/threads/mysql-collation-utf8-differences.2721197/)

// Daten einfügen
function DatenEinfuegen ($Benutzername, $BenVorname, $BenNachname, $BenTelefonnummer, $BenLongitude, $BenLatitude, $BenGeoTime, $BenPasswort) //func name= Registrieren?
{
global $db;
//Tabelle füllen
$sql = "INSERT INTO tbenutzer (BenutzerId, BenNickname, BenVorname, BenNachname, BenTelefonnummer, BenLongitude, BenLatitude, BenGeoTime, BenPasswort) VALUES (NULL, '$Benutzername', '$BenVorname', '$BenNachname', '$BenTelefonnummer', '$BenLongitude', '$BenLatitude', '$BenGeoTime','$BenPasswort');";
$sql = mysqli_query($db, $sql) or die ("Error message: " . mysqli_error($db));
}

// Daten auslesen
DatenEinfuegen("Hanswurst","Peter","Hansel","sfdsd",5,3,"now()","");
DatenAuslesen(1000);
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
