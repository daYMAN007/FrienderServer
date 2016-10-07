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
    return json_encode($userarr);
}
function isOnlineDatenAuslesen ($BenutzerId,  $sql)
{
  //Tabelle auselsen
  global $db;
  $sqb="select now()";
    $result = mysqli_query($db,$sqb ) or die ("Error message: " . mysqli_error($db));
    $row = $result->fetch_assoc();
    $nowsql=$row['now()'];
  $result = mysqli_query($db, $sql) or die ("Error message: " . mysqli_error($db));
  $userarr = [];
  while ($row = $result->fetch_assoc()){
    $now = strtotime($nowsql);
 $target = strtotime($row['BenGeoTime']);
 $diff = $now - $target;

//15 minuten 15*60 = 900
 if ($diff <= 900) {
   $row['isOnline']=true;
 } else {
   $row['isOnline']=false;
}
  $userarr[]=$row;
  }
    return json_encode($userarr);
}

// PosDaten aktualisieren
function PositionUpdate($BenutzerId,$BenLongitude, $BenLatitude)
{
global $db;
//Tabelle updaten
$sql = "UPDATE tbenutzer set BenLongitude=$BenLongitude, BenLatitude=$BenLatitude, BenGeoTime=now() where BenutzerId = '$BenutzerId';";
mysqli_query($db, $sql) or die ("Error message: " . mysqli_error($db));
}

// Einstellungs änderung:
function Userupdate($BenutzerId,$Benutzername,$BenPasswort,$BenTelefonnummer,$BenVorname,$BenNachname)
{
  global $db;
  $sql = "update tbenutzer set BenNickname='$Benutzername', BenVorname='$BenVorname',BenNachname='$BenNachname',BenTelefonnummer='$BenTelefonnummer',BenPasswort='$BenPasswort' where BenutzerId = '$BenutzerId'; ";
echo $sql;
  mysqli_query($db, $sql) or die ("Error message: " . mysqli_error($db));

}
