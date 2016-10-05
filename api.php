<?php
require_once 'libary.php'; //todo pw dont work at all
$myData = json_decode($_POST['myData'],true);
print_r($myData);
$action = $myData['action'];

switch ($action){
      case "Registrieren":
      $BenPasswort=hashpw($myData['BenPasswort']);
      $Benutzername=$myData['Benutzername'];
      $BenVorname=$myData['BenVorname'];
      $BenNachname=$myData['BenNachname'];
      $BenTelefonnummer=$myData['BenTelefonnummer'];
      $BenLongitude=$myData['BenLongitude'];
      $BenLatitude=$myData['BenLatitude'];
      $BenGeoTime=$myData['BenGeoTime'];
      Registrieren($Benutzername, $BenVorname, $BenNachname, $BenTelefonnummer, $BenLongitude, $BenLatitude, $BenGeoTime, $BenPasswort);
      break;

      case "Login":
      $user= getUser($myData['Benutzername']);
      if($user==null)
      {
        echo "0";
      }
      else if(login($user,$myData['BenPasswort']))
      {
        echo "1";
      }
      else {
        echo "2";
      }
      break;
}
