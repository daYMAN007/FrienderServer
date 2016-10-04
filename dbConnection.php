<?php
//Verbindung zur Datenbank aufbauen
$BenutzerId;
$Benutzername;
$BenVorname;
$BenNachname;
$BenTelefonnummer;
$BenLongitude;
$BenLatitude;
$BenGeoTime;
$BenPasswort;

// Daten einfügen
function DatenEinfuegen ($Benutzername, $BenVorname, $Nachname, $BenTelefonnummer, $BenLongitude, $BenLatitude, $BenGeoTime, $BenPasswort)
{
$db = @new mysqli('localhost', 'root', '', 'frienderdb');
mysqli_set_charset('utf8');
require_once('config.php');
$link = mysqli_connect(MY_HOST, MY_USER, MY_PASSWORD, MY_DB);
if(mysqli_connect_errno())
{
  echo "Sie besitzen leider keine Internetverbindung. Verbinden Sie sich bitte mit dem Internet.";
  exit();
}else{
  // echo "Connection established.";
}

// Charset definieren
mysqli_set_charset($link, 'utf8mb4');

//Tabelle füllen
$sql = "INSERT INTO tbenutzer (BenutzerId, BenNickname, BenVorname, BenNachname, BenTelefonnummer, BenLongitude, BenLatitude, BenGeoTime, BenPasswort) VALUES (NULL, '$Benutzername', '$BenVorname', '$BenNachname', '$BenTelefonnummer', '$BenLongitude', '$BenLatitude', '$BenGeoTime','$BenPasswort');";
$sql = mysqli_query($link, $sql) or die ("Error message: " . mysqli_error($link));
}

// Daten auslesen
function DatenAuslesen ()
{
  $db = @new mysqli('localhost', 'root', '', 'frienderdb');
  mysqli_set_charset('utf8');
  require_once('config.php');
  $link = mysqli_connect(MY_HOST, MY_USER, MY_PASSWORD, MY_DB);
  if(mysqli_connect_errno())
  {
    echo "Sie besitzen leider keine Internetverbindung. Verbinden Sie sich bitte mit dem Internet.";
    exit();
  }else{
    // echo "Connection established.";
  }

  // Charset definieren
  mysqli_set_charset($link, 'utf8mb4');

  //Tabelle auselsen
  $sql = "SELECT * FROM tbenutzer WHERE BenutzerId = '$BenutzerId';";
  $sql = mysqli_query($link, $sql) or die ("Error message: " . mysqli_error($link));
  $user = $sql->query($sql)->fetch();
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
function DatenUpdaten ($BenutzerId, $Benutzername, $BenVorname, $BenNachname, $BenTelefonnummer, $BenLongitude, $BenLatitude, $BenGeoTime, $BenPasswort)
$db = @new mysqli('localhost', 'root', '', 'frienderdb');
mysqli_set_charset('utf8');
require_once('config.php');
$link = mysqli_connect(MY_HOST, MY_USER, MY_PASSWORD, MY_DB);
if(mysqli_connect_errno())
{
  echo "Sie besitzen leider keine Internetverbindung. Verbinden Sie sich bitte mit dem Internet.";
  exit();
}else{
  // echo "Connection established.";
}

//Charset definieren
mysqli_set_charset($link, 'utf8mb4');

//Tabelle updaten
$sql = "UPDATE tbenutzer set (BenLongitude, BenLatitude, BenGeoTime) VALUES ('$BenLongitude', '$BenLatitude', '$BenGeoTime') where BenutzerId = '$BenutzerId';";
$sql = mysqli_query($link, $sql) or die ("Error message: " . mysqli_error($link));


//To do
//-Datenüberprüfung,
